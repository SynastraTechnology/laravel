<?php
use Illuminate\Support\Facades\Route;
use Modules\Products\Controllers\ProductController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource('products', ProductController::class);
});
