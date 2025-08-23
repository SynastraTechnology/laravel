<?php
use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\Api\AuthApiController;

Route::prefix('api/v1')->group(function () {
    // Public routes
    Route::post('login', [AuthApiController::class, 'login']);
    Route::post('register', [AuthApiController::class, 'register']);
    Route::post('forgot-password', [AuthApiController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthApiController::class, 'resetPassword']);
    
    // Protected routes
    Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
        Route::post('logout', [AuthApiController::class, 'logout']);
        Route::get('user', [AuthApiController::class, 'user']);
        Route::post('refresh-token', [AuthApiController::class, 'refreshToken']);
    });
});
