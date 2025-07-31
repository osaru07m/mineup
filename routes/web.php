<?php

use App\Http\Middleware\Auth\CheckStatus;
use App\Http\Middleware\Auth\ForceChangePasswordRedirect;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware(['auth', ForceChangePasswordRedirect::class, CheckStatus::class])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
});
