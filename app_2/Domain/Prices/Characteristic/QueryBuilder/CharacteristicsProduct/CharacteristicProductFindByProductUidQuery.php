<?php

namespace App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicProductQuery;

class CharacteristicProductFindByProductUidQuery extends CharacteristicProductQuery {

    public function __construct(
        private string $uid,
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    ){}

    public function run()
    {
        return  $this->getModel()
                    ->where('product_uid',$this->uid)
                    ->with($this->request->include)
                    ->get();
    }
}
