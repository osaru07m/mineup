<?php

namespace App\Http\Middleware\Auth;

use App\Models\Users\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $excludedPaths = [
            'login'
        ];

        if (
            Auth::guard('web')->check() &&
            Auth::guard('web')->user()->status === User::STATUS_LOCKED &&
            !collect($excludedPaths)->contains(fn ($path) => $request->is($path))
        ) {
            Auth::guard('web')->logout();

            return redirect()->route('login');
        }

        return $next($request);
    }
}
