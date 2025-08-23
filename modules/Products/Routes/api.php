<?php
use Illuminate\Support\Facades\Route;
use Modules\Products\Controllers\Api\ProductApiController;

Route::prefix('api/v1')->middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::apiResource('products', ProductApiController::class);
    
    // Additional product endpoints
    Route::get('products/search/{keyword}', [ProductApiController::class, 'search']);
    Route::get('products/category/{category}', [ProductApiController::class, 'getByCategory']);
    Route::patch('products/{product}/stock', [ProductApiController::class, 'updateStock']);
    Route::get('products/low-stock', [ProductApiController::class, 'getLowStock']);
});
