<?php

namespace Domain\Prices\Bonus\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;

class BonusFindById extends BonusQuery {

    public function __construct(
        private int $id,
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    ){}

    public function run()
    {
        return  $this->getModel()->newQuery()
                    ->where('id',$this->id)
                    ->with($this->request->include)
                    ->first();
    }
}
