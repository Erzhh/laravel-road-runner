<?php

namespace Domain\Import\Services;

use Domain\Catalog\QueryBuilder\PriceType\GetAllPriceType;
use Domain\Catalog\QueryBuilder\Product\FetchProductsByUid;
use Domain\Import\DTO\PriceDocumentImportDTO;
use Illuminate\Support\Facades\DB;

class PriceDocumentChangeProductPriceImportService
{

    public function __construct(
        private PriceDocumentImportDTO $apiData
    ){}

    public function run(){

        $products_uids = collect( $this->apiData->items )->pluck('product')->toArray();

        $products =   (new FetchProductsByUid(
                                                $products_uids,
                                                ['id','uid'],
                                                []
                                                ))->run();

        $pluck_product = collect($products)->pluck('uid')->toArray();

        $price_types =  (new GetAllPriceType())->run();
        $pluck_price_types = collect($price_types)->pluck('uid','id')->toArray();

        //Генерация(подбор) данных
        try {
            $dbData = [];
            foreach ($this->apiData->items as $item) {

                $product_key =     $this->ArraySearchOrNullable( $item->product, $pluck_product );
                $price_type_key =  $this->ArraySearchOrNullable( $item->cost_type, $pluck_price_types );

                if($product_key >= 0){
                    $dbData[] = [
                        'product_id' => $products[$product_key]['id'],
                        'price_type_id' =>  $price_type_key,
                        'quality_id' =>  1,
                        'cost'=> $item->cost
                    ];
                }

            }
        }catch (\Exception $e){
            abort(501, "Замена цен у продуктов прошло неуспешно");
        }

        //Запись цены историй
        try {
            DB::table('prices')->upsert(
                $dbData, // Данные для вставки
                ['product_id','price_type_id'], // Поля для проверки уникальности
                ['cost']    // Изменение полей
            );
        }catch (\Exception $e){
            abort(501, "Замена цен у продуктов прошло неуспешно". $e);
        }

    }

    private function ArraySearchOrNullable($array, $compare_array): int|string|null
    {
        $found_array = array_search( $array , $compare_array);
        return $found_array >= 0?$found_array:null;
    }

}
