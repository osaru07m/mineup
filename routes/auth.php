<?php

use App\Http\Controllers\Auth\AuthSessionController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [AuthSessionController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthSessionController::class, 'login']);

Route::get('/logout', [AuthSessionController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/change-password', [AuthSessionController::class, 'showChangePasswordForm'])->name('changePassword');
    Route::post('/change-password', [AuthSessionController::class, 'changePassword']);
});
