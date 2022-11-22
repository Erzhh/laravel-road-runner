<?php

namespace App\Domain\Access\User\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;
use Illuminate\Database\Eloquent\Model;

class UserFindByLogin extends UserQuery {

    public function __construct(
        private string $login,
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    ){}

    public function run()
    {
        return  $this->getModel()->newQuery()
                    ->where('login',$this->login)
                    ->with($this->request->include)
                    ->first();
    }
}
