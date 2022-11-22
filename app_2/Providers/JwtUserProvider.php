<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        $token = JWTAuth::getToken();
        $payload = JWTAuth::getPayload($token);
        return new AuthUser($payload);
    }

    public function retrieveByToken($identifier, $token)
    {
        //
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }
}
