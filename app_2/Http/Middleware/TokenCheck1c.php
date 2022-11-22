<?php

namespace App\Http\Middleware;

use Closure;
use Core\Exceptions\OneSException;
use Illuminate\Http\Request;

class TokenCheck1c
{
    public function handle(Request $request, Closure $next)
    {
        if($request->header('X-QR-TOKEN') == env('1C_TOKEN')){
            return $next($request);
        }
        throw new OneSException();
    }
}
