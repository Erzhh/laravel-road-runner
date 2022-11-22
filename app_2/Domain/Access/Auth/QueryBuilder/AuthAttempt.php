<?php
namespace App\Domain\Access\Auth\QueryBuilder;

use API\Access\DTO\UserLoginDTO;
use Illuminate\Support\Facades\Auth;

class AuthAttempt{

    public function __construct(
        private UserLoginDTO $credentials
    )
    {}

    public function run():string
    {
        $token = Auth::guard()->attempt( $this->credentials->toArray() );

        return  $token;
    }

}
