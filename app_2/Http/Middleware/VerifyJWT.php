<?php

namespace App\Http\Middleware;

use Closure;
use Core\ErrorResponse;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWT
{
    use ErrorResponse;

    public function handle( $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->throwMessage('Token is Invalid', 401);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->throwMessage('Token is Expired', 401);
            }else{
                return $this->throwMessage('Authorization Token not found', 401);
            }
        }
        return $next($request);
    }
}
