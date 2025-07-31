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

    Route::get('/setting', [SettingController::class, 'showForm'])->name('setting');
    Route::post('/setting/info', [SettingController::class, 'updateInfo'])->name('setting.info');
    Route::post('/setting/options')->name('setting.options');

    Route::prefix('/admin')->as('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/activities', [ActivityController::class, 'index'])->name('activities');
    });
});
