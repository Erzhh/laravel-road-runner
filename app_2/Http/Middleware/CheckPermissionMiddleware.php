<?php

namespace App\Http\Middleware;

use Domain\Access\Permission\QueryBuilder\PermissionFindByAliasAndRole;
use Illuminate\Support\Facades\Route;
use Closure;

class CheckPermissionMiddleware
{
    public function handle($request,Closure $next)
    {
        try{
        $route_name= Route::currentRouteName();
        $permission =  (new PermissionFindByAliasAndRole($route_name))->run();

            if(empty($permission['roles']))
                return $next($request);
            else
                abort(401,"Доступ запрещен!");
        }
        catch (\Exception $e) {
            abort(401,"Доступ запрещен!");
        }
    }
}
