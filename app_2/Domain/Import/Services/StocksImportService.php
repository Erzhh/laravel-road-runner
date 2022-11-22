<?php

namespace Domain\Import\Services;

use Domain\Import\Helpers\ImportHelper;
use Domain\Import\Interfaces\CatalogRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class StocksImportService
{
    private CatalogRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRepository::class);
    }

    /**
     *  $data[0] = [
     *      "product_id" => "76000003174",
     *      "product_guid" => "28ba63d9-1538-11eb-80bd-04d4c4d2e516",
     *      "warehouse_id" => "HQ1000107",
     *      "warehouse_guid" => "d8176c4f-bc48-11ea-80bf-bc97e145c061",
     *      "quality_id" => "6",
     *      "quality_guid" => "c5c7e039-b9f7-11eb-80cb-bc97e145c062",
     *      "quantity" => 3
     *  ];
     */
    public function run(){
        $apiData = $this->repository->getStocks();

        $warehouses = ImportHelper::warehousesUidMap();
        $qualities = ImportHelper::qualitiesUidMap();
        $products = ImportHelper::productsUidMap();

        $dbData = [];

        foreach ($apiData as $apiItem) {

            $dbItem = [
                'warehouse_id' => $warehouses[$apiItem['warehouse_guid']] ?? null,
                'product_id' => $products[$apiItem['product_guid']] ?? null,
                'quality_id' => $qualities[$apiItem['quality_guid']] ?? null,
                'quantity' => (int) $apiItem['quantity'],
            ];

            $this->validateDbItem($dbItem, $apiItem);

            $dbData[] = $dbItem;
        }

        $chunks = array_chunk($dbData, 1000);
        foreach ($chunks as $chunk) {
            DB::table('stocks')->upsert(
                $chunk,                                         // Данные для вставки
                ['warehouse_id', 'product_id', 'quality_id'],   // Поля для проверки уникальности
                ['quantity']                                    // Поля обновления
            );
        }
    }

    private function validateDbItem(array $dbItem, array $apiItem){
        if (!isset($dbItem['warehouse_id'])) {
            throw new \DomainException('Склад не найден. '.json_encode($apiItem));
        }
        if (!isset($dbItem['quality_id'])) {
            throw new \DomainException('Качество не найдено. '.json_encode($apiItem));
        }
        if (!isset($dbItem['product_id'])) {
            throw new \DomainException('Товар не найден. '.json_encode($apiItem));
        }
    }
}
