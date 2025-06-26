<?php

use Illuminate\Support\Facades\Route;
use Modules\Posts\Controllers\PostController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource('posts', PostController::class);
});