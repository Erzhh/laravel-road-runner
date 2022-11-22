<?php

use API\Searchable\Catalog\Controllers\CategorySearchController;
use Illuminate\Support\Facades\Route;

    Route::get('/categories-product', [CategorySearchController::class, 'categories_product'])
                                            ->name('categories_product');
