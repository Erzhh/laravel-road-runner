<?php

namespace Domain\Import\Services;

use Domain\Import\Interfaces\CatalogRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class QualitiesImportService
{
    private CatalogRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRepository::class);
    }

    /**
     * Сохраняет в БД список тип цен
     *
     *  $apiData[0] = [
     *      'id' => 'HQ1000002',
     *      'guid' => 'b820b342-32a5-11e6-a40c-001e670c9280',
     *      'name' => 'Использовано',
     *      'status' => true,
     *  ];
     * @return void
     */
    public function run(){
        $apiData = $this->repository->getQualityTypes();

        $dbData = [];

        foreach ($apiData as $item) {
            $dbData[] = [
                'uid' => $item['guid'],
                'name' => $item['name'],
                'code' => $item['id'],
                'alias' => $item['id'],
                'status' => (int) $item['status'],
            ];
        }

        DB::table('qualities')->upsert(
            $dbData, // Данные для вставки
            ['uid'], // Поля для проверки уникальности
            ['name', 'code', 'status'] // Поля обновления
        );
    }
}
