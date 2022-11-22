<?php

use API\Settings\Controllers\{CharacteristicMessageController,ErrorController};
use Illuminate\Support\Facades\Route;

Route::apiResource('error' , ErrorController::class)
                        ->only(['index','show','store']);

Route::delete('error/{error}',[ErrorController::class,'delete']);

Route::apiResource('characteristic_message' , CharacteristicMessageController::class)
    ->only(['index','destroy']);
