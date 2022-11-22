<?php

namespace App\Domain\Access\User\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;

class UserFindById extends UserQuery {

    public function __construct(
        private int $id,
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    )
    {}

    public function run()
    {
        return  $this->getModel()->newQuery()
                    ->where('id',$this->id)
                    ->with($this->request->include)
                    ->first();
    }
}
