<?php

use Illuminate\Support\Facades\Route;
use API\Catalog\Controllers\{
                                CategoryController,
                                PriceDocumentController,
                                PriceHistoryController,
                                ProductController,
                                ProductDetailController,
                                StockController
                            };

Route::prefix('categories/')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/list', [CategoryController::class, 'list'])->name('list');
    Route::get('/list/brands', [CategoryController::class, 'brands'])->name('brands');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
    Route::post('/{category:uid}/format', [CategoryController::class, 'format'])->name('format');
});

Route::prefix('products/')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
    Route::post('/{product:uid}/format', [ProductController::class, 'format'])->name('format');
});

Route::prefix('stock/')->name('stock.')->group(function () {
    Route::get('/product/{product}', [StockController::class, 'product'])->name('product');
    Route::get('{warehouse_id}/{product_id}/{quality_id}', [StockController::class, 'show'])->name('show');
});

Route::prefix('price-document/')->name('price_documents.')->group(function (){
    Route::get('/',[PriceDocumentController::class,'index'])->name('index');
    Route::get('/{id}',[PriceDocumentController::class,'show'])->name('show')
            ->where('id', '[0-9]+');
});

Route::prefix('/price-history/')->name('price_histories.')->group(function (){
    Route::get('/',[PriceHistoryController::class,'index'])->name('index');
    Route::get('/{id}',[PriceHistoryController::class,'show'])->name('show');
    Route::get('/{document}/price-document',[PriceHistoryController::class,'parent'])
                    ->name('parent')->where('document', '[0-9]+');
});

Route::prefix('/product-detail/')->name('product_detail.')->group(function (){
    Route::get('/',[ProductDetailController::class,'index'])->name('index');
    Route::get('/{id}',[ProductDetailController::class,'show'])->name('show');
});
