<?php
namespace App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct;

use App\Domain\Prices\Characteristic\DTO\CharacteristicSimilarDTO;
use Domain\Catalog\QueryBuilder\Product\FindProductByUId;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicProductQuery;

class GetAllSimilarCharacteristicProductQuery extends CharacteristicProductQuery {

    public function __construct(
        public CharacteristicSimilarDTO $dto
    ){}

    public function run()
    {
        $query = $this->getModel()
            ->newQuery()
            ->whereIn('characteristic_id',$this->dto->uuids())
            ->where('product_uid','!=',$this->dto->getProduct())
            ->get(['product_uid','id','characteristic_id']);

        $filter_query = $query
                        ->groupBy('product_uid',false)
                        ->filter(function ($item, $key){
                            if(count( $item ) == $this->dto->countUids()){
                                return $key;
                            }
                        })
                        ->each(function ($product,$key){

                            $product['product'] = (new FindProductByUId($key,[]))->run(['id','full_name'])
                                                    ??[];

                            return $product;
                        });


        return $filter_query;
    }

}
