<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as UserProviderContract;

class CustomProvider implements UserProviderContract
{
    public function retrieveById($identifier) {}

    public function retrieveByCredentials(array $credentials) {}

    public function validateCredentials(Authenticatable $user, array $credentials) {}

    public function retrieveByToken($identifier, $token) {}

    public function updateRememberToken(Authenticatable $user, $token) {}
}
