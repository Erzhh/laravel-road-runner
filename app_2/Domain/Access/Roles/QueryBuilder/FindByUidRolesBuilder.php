<?php

namespace App\Domain\Access\Roles\QueryBuilder;

class FindByUidRolesBuilder extends RoleQuery
{
    public function __construct(
        private $uid_lists
    )
    {}

    public function run(): array
    {
        return $this->getModel()->query()
                        ->whereIn('uuid',$this->uid_lists)
                        ->select('id','uuid')
                        ->pluck('uuid','id')->toArray();

    }

}
