<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Middleware\Auth\CheckStatus;
use App\Http\Middleware\Auth\ForceChangePasswordRedirect;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware(['auth', ForceChangePasswordRedirect::class, CheckStatus::class])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::prefix('/setting')->group(function () {
        Route::get('/', [SettingController::class, 'showForm'])->name('setting');

        Route::post('/info', [SettingController::class, 'updateInfo'])->name('setting.info');
        Route::post('/auth', [SettingController::class, 'updateAuth'])->name('setting.auth');
    });

    Route::prefix('/admin')->as('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/activities', [ActivityController::class, 'index'])->name('activities');
    });
});
