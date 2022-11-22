<?php

namespace App\Domain\Prices\Characteristic\QueryBuilder\Characteristics;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicQuery;
use Illuminate\Database\Eloquent\Model;

class CharacteristicFindById extends CharacteristicQuery {

    public function __construct(
        public int $id,
        private RequestParamsDTO $request = new RequestParamsDTO()
    ){}

    public function run():Model
    {
        return  $this->getModel()
                    ->newQuery()
                    ->where('id',$this->id)
                    ->with( $this->request->include)
                    ->first();
    }
}
