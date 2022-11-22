<?php

namespace App\Domain\Access\Roles\QueryBuilder;

use App\Domain\Access\Roles\Models\Role;
use Core\BaseQuery;
use Illuminate\Database\Eloquent\Model;

class RoleQuery implements BaseQuery{

    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new Role();
    }
}
