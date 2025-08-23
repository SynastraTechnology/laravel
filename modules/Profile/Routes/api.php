<?php
use Illuminate\Support\Facades\Route;
use Modules\Profile\Controllers\Api\ProfileApiController;

Route::prefix('api/v1')->middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::get('profile', [ProfileApiController::class, 'show']);
    Route::put('profile', [ProfileApiController::class, 'update']);
    Route::post('profile/avatar', [ProfileApiController::class, 'updateAvatar']);
    Route::delete('profile/avatar', [ProfileApiController::class, 'deleteAvatar']);
    Route::post('profile/password', [ProfileApiController::class, 'updatePassword']);
});
