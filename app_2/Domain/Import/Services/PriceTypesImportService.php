<?php

namespace Domain\Import\Services;

use Domain\Import\Repositories\CatalogRemoteRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PriceTypesImportService
{
    private CatalogRemoteRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRemoteRepository::class);
    }

    /**
     * Сохраняет в БД список тип цен
     *
     *  $apiData[0] = [
     *      'id' => '000000003',
     *      'guid' => '5a58509a-50d0-11e1-beb2-0027133dad0a',
     *      'name' => 'Розничная Шымкент',
     *      'status' => true,
     *  ];
     *
     * @return void
     */
    public function run(){
        $apiData = $this->repository->getPriceTypes();

        $dbData = [];

        foreach ($apiData as $item) {
            $dbData[] = [
                'uid' => $item['guid'],
                'name' => $item['name'],
                'code' => $item['id'],
                'status' => (int) $item['status'],
            ];
        }

        DB::table('price_types')->upsert(
            $dbData, // Данные для вставки
            ['uid'], // Поля для проверки уникальности
            ['name', 'code', 'status'] // Поля обновления
        );


    }
}
