<?php

namespace App\Domain\Access\User\Actions;

use App\Domain\Access\User\DTO\UserDto;
use App\Domain\Access\User\Services\UserStoreService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class  UserStoreAction
{
    public function __construct(
        private UserDto $dto
    ){}

    public function run(): Model|Builder
    {
        try {
            $user = (new UserStoreService($this->dto))->run();

            return $user;
        }
        catch (\Exception $e){
            return abort(500, $e);
        }
    }
}
