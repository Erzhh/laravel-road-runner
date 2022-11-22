<?php

use API\Import\Controllers\{OneSController};
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'ones','as'=>'ones.'],function (){
    Route::post('price_document',[OneSController::class,'price_document']);
    Route::post('categories',[OneSController::class,'categories']);
    Route::post('product',[OneSController::class,'product']);
    Route::post('characteristics',[OneSController::class,'characteristics']);
});
