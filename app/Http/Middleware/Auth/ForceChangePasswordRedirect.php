<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForceChangePasswordRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $excludedPaths = [
            'login',
            'logout',
            'change-password'
        ];

        if (
            Auth::check() &&
            Auth::user()->is_change_password_required &&
            !collect($excludedPaths)->contains(fn ($path) => $request->is($path))
        ) {
            return redirect()->route('changePassword');
        }

        return $next($request);
    }
}
