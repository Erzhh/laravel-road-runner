<?php

namespace App\Domain\Access\User\QueryBuilder;

use App\Domain\Access\User\DTO\UserTokenUpdateDto;

class UserFindByToken extends UserQuery {

    public function __construct(
        public UserTokenUpdateDto $dto
    ){}

    public function run()
    {
        try {
            return  $this->getModel()->newQuery()
                ->where('refresh_token', $this->dto->refresh_token)
                ->first();
        }
        catch (\Exception $exception){
            abort(404,$exception->getMessage());
        }

    }
}
