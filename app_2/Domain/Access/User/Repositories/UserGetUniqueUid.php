<?php
namespace App\Domain\Access\User\Repositories;

use App\Domain\Access\User\QueryBuilder\UserFindByUid;
use App\Domain\Access\User\QueryBuilder\UserQuery;
use Illuminate\Support\Str;

class UserGetUniqueUid extends UserQuery{

    public function run()
    {
        $token = Str::uuid();
        if(!(new UserFindByUid($token))->run())
            return $token;
        else
            $this->run();
    }
}
