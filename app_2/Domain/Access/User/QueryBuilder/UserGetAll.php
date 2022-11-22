<?php

namespace App\Domain\Access\User\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;

class UserGetAll extends UserQuery {

    public function __construct(
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    ){}

    public function run()
    {
        return $this->getModel()
                    ->select('id', 'full_name','login','role_id','uid')
                    ->with($this->request->include)
                    ->get();
    }
}
