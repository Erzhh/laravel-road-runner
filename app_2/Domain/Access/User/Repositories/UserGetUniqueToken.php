<?php
namespace App\Domain\Access\User\Repositories;

use App\Domain\Access\User\DTO\UserTokenUpdateDto;
use App\Domain\Access\User\QueryBuilder\UserFindByToken;
use App\Domain\Access\User\QueryBuilder\UserQuery;
use Illuminate\Support\Str;

class  UserGetUniqueToken extends UserQuery{


    public function run()
    {
        $token = new UserTokenUpdateDto([
                       'refresh_token' => Str::uuid()
                    ]);

        if(!(new UserFindByToken($token))->run())
            return $token;
        else
            $this->run();
    }
}
