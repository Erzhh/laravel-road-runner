<?php

namespace Domain\Import\Services;

use Domain\Import\Interfaces\CatalogRepository;
use Domain\Import\Repositories\CatalogRemoteRepository;
use DomainException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Domain\Import\Helpers\ImportHelper;

class PricesImportService
{
    private CatalogRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRemoteRepository::class);
    }

    /**
     * $apiData[0] = [
     *    'product_id' => '00000000822',
     *    'product_guid' => '1e84e98b-51cf-11e1-bfad-0027133dad0a',
     *    'cost_type_id' => 'HQ1000002',
     *    'cost_type_guid' => "efc9496d-b790-11e1-afc8-001e670c9281",
     *    'cost' => 5900,
     * ]
     */
    public function run(){

        $apiData = $this->repository->getPrices();

        $dbData = [];

        $products = ImportHelper::productsUidMap();
        $priceTypes = ImportHelper::priceTypesUidMap();

        foreach ($apiData as $price) {
            $dbItem = [];
            $product_id = $products[$price['product_guid']] ?? null;
            $price_type_id = $priceTypes[$price['cost_type_guid']] ?? null;

            if($product_id && $price_type_id){
                $dbItem = [
                    'product_id' => $product_id,
                    'price_type_id' => $price_type_id,
                    'quality_id' => 1,
                    'cost' => (int) $price['cost'],
                ];
            }

//            $this->validateDbItem($dbItem, $price);

            $dbData[] = $dbItem;
        }

        $chunks = array_chunk($dbData, 1000);
        foreach ($chunks as $chunk) {
            DB::table('prices')->upsert(
                $chunk, // Данные для вставки
                ['product_id', 'price_type_id'], // Поля для проверки уникальности
                ['cost'] // Поля обновления
            );
        }
    }

    private function validateDbItem(array $dbItem, array $apiItem){
        if (!$dbItem['product_id']) {
            throw new DomainException('Товар не найден: '.json_encode($apiItem));
        }
        if (!$dbItem['price_type_id']) {
            throw new DomainException('Тип цены не найден: '.json_encode($apiItem));
        }
    }
}
