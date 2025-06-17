<?php
use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\LoginController;
use Modules\Auth\Controllers\RegisterController;

Route::middleware(['web', 'guest'])->group(function() {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware(['web', 'auth'])->group(function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});