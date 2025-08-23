<?php
use Illuminate\Support\Facades\Route;
use Modules\PixelArt\Controllers\PixelArtController;

Route::middleware(['web'])->group(function () {
    Route::get('pixel-art', [PixelArtController::class, 'index'])->name('pixelart.index');
    Route::get('pixel-art/converter', [PixelArtController::class, 'converter'])->name('pixelart.converter');
    Route::get('pixel-art/gallery', [PixelArtController::class, 'gallery'])->name('pixelart.gallery');
    Route::post('pixel-art/process', [PixelArtController::class, 'process'])->name('pixelart.process');
    Route::get('pixel-art/download', [PixelArtController::class, 'download'])->name('pixelart.download');
});
