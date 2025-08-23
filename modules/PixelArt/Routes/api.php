<?php
use Illuminate\Support\Facades\Route;
use Modules\PixelArt\Controllers\Api\PixelArtApiController;

Route::prefix('api/v1')->group(function () {
    Route::get('pixel-art/generate', [PixelArtApiController::class, 'generate']);
    Route::post('pixel-art/upload', [PixelArtApiController::class, 'upload']);
    Route::get('pixel-art/presets', [PixelArtApiController::class, 'getPresets']);
    Route::get('pixel-art/download', [PixelArtApiController::class, 'download']);
});
