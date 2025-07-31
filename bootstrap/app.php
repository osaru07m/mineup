<?php

use App\Http\Middleware\Auth\CheckStatus;
use App\Http\Middleware\Auth\ForceChangePasswordRedirect;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(CheckStatus::class);
        $middleware->append(ForceChangePasswordRedirect::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
