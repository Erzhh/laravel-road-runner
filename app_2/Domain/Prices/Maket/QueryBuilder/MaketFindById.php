<?php

namespace Domain\Prices\Maket\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;

class MaketFindById extends MaketQuery {

    public function __construct(
        private int $id,
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    )
    {}

    public function run()
    {
        return  $this->getModel()
                    ->when($this->request->fields,function($q){
                        $q->select($this->request->fields);
                    })
                    ->where('id',$this->id)
                    ->with($this->request->include)
                    ->first();
    }
}
