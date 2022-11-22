<?php

namespace App\Domain\Access\Auth\Repositories;


use App\Domain\Access\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthWithTokenRepository{

    public function __construct(
        private User $user,
        private string $token
    )
    {}

    public function run(){

       return [
            'access_token' => $this->token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard()->factory()->getTTL(),
            'refresh_token' => $this->user->refresh_token
        ];
    }

}
