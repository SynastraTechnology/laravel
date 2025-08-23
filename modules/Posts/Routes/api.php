<?php
use Illuminate\Support\Facades\Route;
use Modules\Posts\Controllers\Api\PostApiController;

Route::prefix('api/v1')->middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::apiResource('posts', PostApiController::class);
    
    // Additional post endpoints
    Route::get('posts/search/{keyword}', [PostApiController::class, 'search']);
    Route::get('posts/user/{userId}', [PostApiController::class, 'getByUser']);
    Route::patch('posts/{post}/publish', [PostApiController::class, 'publish']);
    Route::patch('posts/{post}/unpublish', [PostApiController::class, 'unpublish']);
});
