<?php
namespace App\Domain\Access\Auth\Actions;

use App\Domain\Access\Auth\Repositories\AuthWithTokenRepository;
use App\Domain\Access\User\Actions\UserUpdateRefreshTokenAction;
use App\Domain\Access\User\DTO\UserTokenUpdateDto;

class AuthRefreshAction{

    public function __construct(
        private UserTokenUpdateDto $dto
    )
    {}

    public function run(): array
    {

        $user = (new UserUpdateRefreshTokenAction( $this->dto) )->run();

        $token = auth()->login($user);

        return (new AuthWithTokenRepository($user, $token))->run();
    }
}
