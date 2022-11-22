<?php

namespace App\Domain\Access\Auth\Actions;

use API\Access\DTO\UserLoginDTO;
use App\Domain\Access\Auth\QueryBuilder\AuthAttempt;
use App\Domain\Access\Auth\Repositories\AuthWithTokenRepository;

class AuthLoginAction{

    public function __construct(
        private UserLoginDTO $dto
    )
    {}

    public function run(): \Illuminate\Http\JsonResponse
    {
        $token = (new AuthAttempt( $this->dto ))->run();
        $user = auth()->user();

        if ($token && $user){
            $respondWithToken = (new AuthWithTokenRepository($user, $token))->run();
            return response()->json($respondWithToken);
        }

        return abort(401,'Такого пользователя не найдено или он еще прошел верификацию');
    }
}
