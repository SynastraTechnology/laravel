<?php
use Illuminate\Support\Facades\Route;
use Modules\Profile\Controllers\ProfileController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
