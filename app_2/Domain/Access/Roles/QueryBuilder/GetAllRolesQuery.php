<?php

namespace App\Domain\Access\Roles\QueryBuilder;

use Illuminate\Support\Collection;

class  GetAllRolesQuery extends RoleQuery
{

    public function run(): Collection
    {
        return $this->getModel()
                                ->with('permissions')
                                ->get()
                                ->toBase();
    }

}
