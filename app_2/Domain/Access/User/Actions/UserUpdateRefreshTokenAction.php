<?php

namespace App\Domain\Access\User\Actions;

use App\Domain\Access\User\DTO\UserTokenUpdateDto;
use App\Domain\Access\User\QueryBuilder\UserFindByToken;
use App\Domain\Access\User\Repositories\UserGetUniqueToken;
use App\Domain\Access\User\Services\UserTokenUpdateService;

class  UserUpdateRefreshTokenAction {

    public function __construct(
        private UserTokenUpdateDto $dto
    )
    {}

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function run()
    {

        $unique_token = (new UserGetUniqueToken())->run();

        // Искать пользователя через токен
        $model =  (new UserFindByToken($this->dto))->run();

        // генерация нового токена на пользователя
        $token = new UserTokenUpdateDto(['refresh_token'=> $unique_token->refresh_token]);

        // смена токена у пользователья
        (new UserTokenUpdateService($model,$token))->run();

        return $model;
    }

}
