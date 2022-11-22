<?php
namespace App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsValue;

use Domain\Prices\Characteristic\QueryBuilder\CharacteristicValueQuery;

class GetAllCharacteristicValue extends CharacteristicValueQuery {

    public function __construct(){}

    public function run()
    {
        $query = $this->getModel()
                        ->newQuery()
                        ->get();
        return $query;
    }

}
