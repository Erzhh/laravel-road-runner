<?php

namespace App\Domain\Access\User\QueryBuilder;
use App\Domain\Access\User\Models\User;
use Core\BaseQuery;
use Illuminate\Database\Eloquent\Model;

class UserQuery implements BaseQuery{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new User();
    }
}
