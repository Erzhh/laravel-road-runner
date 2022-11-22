<?php

namespace App\Domain\Access\User\QueryBuilder;


use App\Domain\Access\User\Models\UserCode;
use Core\BaseQuery;
use Illuminate\Database\Eloquent\Model;

class UserCodeQuery implements BaseQuery{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new UserCode();
    }
}
