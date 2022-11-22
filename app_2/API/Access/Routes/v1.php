<?php

use Illuminate\Support\Facades\Route;
use API\Access\Controllers\{RoleController, UserController };

Route::apiResource('roles' , RoleController::class)->only(['index','show','store','update']);
Route::apiResource('users' , UserController::class)->only(['index','store','show','update']);


//foreach (glob(base_path('/app/API/Access/Routes/v1/*.php')) as $file) {
//    Route::middleware('')->group($file);
//}
