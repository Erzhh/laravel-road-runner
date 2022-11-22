<?php

namespace App\Domain\Access\User\Services;

use App\Domain\Access\User\DTO\UserTokenUpdateDto;
use App\Domain\Access\User\Models\User;

class UserTokenUpdateService extends UserService{

    public function __construct(
        private User $user,
        private UserTokenUpdateDto $dto
    )
    {}

    public function run(): bool
    {
        return  $this->getModel()
                     ->where('id', $this->user->id)
                     ->update([ 'refresh_token' => $this->dto->refresh_token ]);


    }
}
