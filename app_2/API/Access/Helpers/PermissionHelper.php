<?php

namespace API\Access\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PermissionHelper
{
    static public function getAllPermissions (): array
    {
        $list_route = [];
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $value) {
            if (!Str::contains($value->getName(), 'ignition') && $value->getName() != "") {
                $list_route[] = $value->getName();
            }
        }

        return $list_route;
    }
}
