<?php

namespace App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicQuery;

class CharacteristicProductFindByIdQuery extends CharacteristicQuery {

    public function __construct(
        private int $id,
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    )
    {}

    public function run()
    {
        return  $this->getModel()
            ->where('id',$this->id)
            ->with($this->request->include)
            ->first();
    }
}
