<?php

namespace Domain\Import\Services;

use Domain\Import\Repositories\CatalogRemoteRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CategoryParentsFillService
{
    private string $table = 'categories';

    private CatalogRemoteRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRemoteRepository::class);
    }

    /**
     * Сохраняет в БД список категорий
     *
     * $apiData[0] = [
     *      'id' => 'RS400018552',
     *      'guid' => 'ee58384b-a8ac-11ea-a208-20040ff8c2a1',
     *      'name' => 'Бытовая и Встраиваемая техника',
     *      'status' => true,
     *      'parent_id' => '00000000002',
     *      'parent_guid' => '5a5850a0-50d0-11e1-beb2-0027133dad0a',
     * ];
     *
     * @return void
     */
    public function run():void
    {
        // Получаем список категорий из 1с
        $apiData = $this->repository->getCategories();
        $apiIndexedItems = $this->getApiItems($apiData);

        // Получаем список категорий из БД
        $categories = DB::table($this->table)->select('id','uid','name','code','status','parent_id')->get();
        $dbIndexedItems = $this->getDbItems();

        $updatedData = [];

        foreach ($categories as $category) {
            $updatedData[] = [
                'id' => $category->id,
                'uid' => $category->uid,
                'name' => $category->name,
                'code' => $category->code,
                'status' => $category->status,
                'parent_id' => $this->getParentId($category->uid, $apiIndexedItems, $dbIndexedItems)
            ];
        }

        DB::table($this->table)->upsert($updatedData, ['id'], ['parent_id']);
    }

    /**
     * @param $uid
     * @return mixed|null
     */
    private function getParentId(string $uid, array $apiIndexedItems, array $dbIndexedItems){
        $parent_id = null;

        $parent_uid = $apiIndexedItems[$uid] ?? null;

        if ($parent_uid) {
            $parent_id = $dbIndexedItems[$parent_uid] ?? null;
        }

        return $parent_id;
    }

    /**
     * @return array
     * [
     *    "uid" => id,
     *    "b5458ba5-18e4-11e7-bfb0-001e670c9280" => 1,
     * ]
     */
    private function getDbItems():array
    {
        $categories = DB::table($this->table)->pluck('id', 'uid');
        $dbData = [];
        foreach ($categories as $uid => $id) {
            $dbData[$uid] = $id;
        }
        return $dbData;
    }

    /**
     * @return array
     * [
     *    "guid" => "parent_guid",
     *    "b5458ba5-18e4-11e7-bfb0-001e670c9280" => "cdb66d97-8ea6-11e5-82ee-001e670c9280",
     * ]
     */
    private function getApiItems(array $apiData):array
    {
        $indexedData = [];

        foreach ($apiData as $item) {
            $indexedData[$item['guid']] = $item['parent_guid'];
        }

        return $indexedData;
    }
}
