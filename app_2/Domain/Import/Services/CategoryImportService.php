<?php

namespace Domain\Import\Services;

use Carbon\Carbon;
use Domain\Import\Repositories\CatalogRemoteRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

/**
 * Класс импортирует список категорий из 1С в БД
 */
class CategoryImportService
{
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
    public function run()
    {
        $apiData = $this->repository->getCategories();

        $now = Carbon::now();

        $categories = collect( $apiData )->chunk(2000);

        foreach ($categories as $category){
            $dbData = [];
            foreach ($category as $item) {
                $data = [
                    'code' => $item['id'],
                    'name' => $item['name'],
                    'uid' => $item['guid'],
                    'updated_at' => $now,
                    'status' => (int) $item['status'],
                ];
                $dbData[] = $data;
            }

            DB::table('categories')->upsert(
                $dbData, // Данные для вставки
                ['uid'], // Поля для проверки уникальности
                ['code', 'name','updated_at', 'status'] // Поля обновления
            );
        }
    }
}
