<?php

use App\Http\Controllers\Auth\AuthSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthSessionController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthSessionController::class, 'login']);

Route::get('/logout', [AuthSessionController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/change-password', [AuthSessionController::class, 'showChangePasswordForm'])->name('changePassword');
    Route::post('/change-password', [AuthSessionController::class, 'changePassword']);
});
