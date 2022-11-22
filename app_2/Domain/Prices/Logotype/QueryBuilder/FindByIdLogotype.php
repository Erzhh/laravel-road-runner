<?php

namespace App\Domain\Prices\Logotype\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Prices\Logotype\QueryBuilder\LogotypeQuery;

class FindByIdLogotype extends LogotypeQuery {

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
