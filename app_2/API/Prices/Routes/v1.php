<?php

use API\Prices\Controllers\{BonusController,
    BonusSettingController,
    CharacteristicController,
    CharacteristicProductController,
    CharacteristicProductSettingController,
    CharacteristicValueController,
    FormatController,
    LogotypeController,
    MaketController,
    PrintedController,
    TestController};

use Illuminate\Support\Facades\Route;

Route::apiResource('formats' , FormatController::class)
                ->only(['index','show','store','update','destroy']);

Route::apiResource('bonuses' , BonusController::class)
                ->only(['index','show','store','update','destroy']);

Route::prefix('bonus-user/')->name('bonus-user.')->group(function () {
    Route::get('/with_uid/{user_uid}', [BonusSettingController::class, 'bonus_user'])->name('with_uid');
});

Route::apiResource('makets' , MaketController::class)
                ->only(['index','show','store','update','destroy']);

Route::apiResource('logotypes' , LogotypeController::class)
                ->only(['index','show','store','destroy']);

Route::post('logotypes/{logotype:id}/categories', [LogotypeController::class, 'categories'])->name('logotypes.categories');

Route::post('/logotypes/{logotype}', [LogotypeController::class, 'update'])->name('update');

Route::apiResource('characteristics' , CharacteristicController::class)
                ->only(['index','show','store','update','destroy']);

Route::apiResource('characteristic-products' , CharacteristicProductController::class)
                ->only(['index','show','store','update','destroy']);

Route::prefix('characteristic-products-similar')->name('characteristic-products.')->group(function () {
    Route::get('/{product:id}', [CharacteristicProductSettingController::class, 'similars_get'])->name('index');
    Route::put('/', [CharacteristicProductSettingController::class, 'similars_update'])->name('update');
});

Route::apiResource('characteristic-values' , CharacteristicValueController::class)
                ->only(['index','store','update','destroy']);

Route::prefix('prints/')->name('prints.')->group(function () {
    Route::post('/documents', [PrintedController::class, 'documents'])->name('documents');
    Route::post('/products', [PrintedController::class, 'products'])->name('products');
});

Route::prefix('test/')->name('test.')->group(function () {
    Route::get('/run', [TestController::class, 'run'])->name('run');
});

