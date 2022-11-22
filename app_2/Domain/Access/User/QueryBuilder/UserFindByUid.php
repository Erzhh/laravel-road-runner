<?php

namespace App\Domain\Access\User\QueryBuilder;

class UserFindByUid extends UserQuery {

    public function __construct(private $uid)
    {}

    public function run()
    {
        return  $this->getModel()
                    ->newQuery()
                    ->where('uid', $this->uid)
                    ->first();
    }
}
