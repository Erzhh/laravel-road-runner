<?php

namespace App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsProduct;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Prices\Characteristic\QueryBuilder\CharacteristicProductQuery;
use Illuminate\Database\Eloquent\Model;

class CharacteristicProductFindByCharacteristicIdQuery extends CharacteristicProductQuery {

    public function __construct(
        public int $id,
        private RequestParamsDTO $request = new RequestParamsDTO()
    )
    {}

    public function run()
    {
        return  $this->getModel()
                        ->newQuery()
                        ->when($this->request->fields,function($q){
                            $q->select($this->request->fields);
                        })
                        ->where('characteristic_id',$this->id)
                        ->with($this->request->include)
                        ->get();
    }
}
