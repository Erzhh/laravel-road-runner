<?php

namespace Domain\Import\Services;

use Domain\Import\Helpers\ImportHelper;
use Domain\Import\Repositories\CatalogRemoteRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProductsImportService
{
    private CatalogRemoteRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRemoteRepository::class);
    }

    /**
     *  $data[0] = [
     *      'id' => 'HQ100005777',
     *      'guid' => '1bf5223b-3fc4-11e3-a438-001e670c9280',
     *      'parent_guid' => '7e7423df-51c8-11e1-bfad-0027133dad0a',
     *      'name' => 'WMUG 5050B (CIS)',
     *      'status' => true,
     *      'fullname' => 'Стиральная машина Hotpoint-Ariston WMUG 5050B (CIS)',
     *  ];
     */
    public function run(){
        $apiData = $this->repository->getProducts();

        $dbArray = [];
        $categoriesMap = ImportHelper::categoriesUidMap();

        foreach ($apiData as $item) {

            if ( !isset($categoriesMap[$item['parent_guid']] ) ){
                throw new \DomainException('Не указана категория: '.$item['name']);
            }

            $dbItem = [
                'uid' => $item['guid'],
                'code' => $item['id'],
                'name' => $item['name'],
                'full_name' => $item['fullname'],
                'status' => (int) $item['status'],
                'category_id' => $categoriesMap[$item['parent_guid']],
            ];
            $dbArray[] = $dbItem;
        }

        $chunks = array_chunk($dbArray, 1000);
        foreach ($chunks as $key => $chunk) {
            DB::table('products')->upsert(
                $chunk, // Данные для вставки
                ['uid'], // Поля для проверки уникальности
                ['code', 'name', 'full_name', 'status', 'category_id'] // Поля обновления
            );
        }
    }
}
