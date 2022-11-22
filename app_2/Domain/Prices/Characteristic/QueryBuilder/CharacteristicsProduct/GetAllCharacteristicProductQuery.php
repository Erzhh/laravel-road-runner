<?php
namespace App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct;

use Domain\Prices\Characteristic\QueryBuilder\CharacteristicProductQuery;

class GetAllCharacteristicProductQuery extends CharacteristicProductQuery {

    public function __construct(){}

    public function run()
    {
        $query = $this->getModel()
            ->newQuery()
            ->get();

        return $query;
    }

}
