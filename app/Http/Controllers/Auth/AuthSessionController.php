<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordFormRequest;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Models\Users\User;
use App\Models\Users\UserActivity;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthSessionController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginFormRequest $request): RedirectResponse
    {
        $remember = $request->has('remember');
        $credentials = $request->only(['login', 'password']);

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $auth = Auth::guard('web')->user();

            if ($auth->status === User::STATUS_LOCKED) {
                Auth::guard('web')->logout();

                return back()->withErrors(['login' => 'アカウントがロックされています。'])->withInput();
            } elseif ($auth->status === User::STATUS_PENDING) {
                Auth::guard('web')->logout();

                return back()->withErrors(['login' => 'アカウントが承認されていません。'])->withInput();
            }

            $auth->last_logged_in_at = now();
            $auth->save();

            if ($auth->is_change_password_required === true) {
                return redirect()->route('changePassword');
            }

            return redirect()->route('home');
        }

        return back()->withErrors(['login' => '認証に失敗しました。'])->withInput();
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();

        return redirect()->route('login');
    }

    public function showChangePasswordForm(): View|RedirectResponse
    {
        if (Auth::user()->is_change_password_required === true) {
            return view('auth.changePassword');
        }

        return back();
    }

    public function changePassword(ChangePasswordFormRequest $request): RedirectResponse
    {
        $newPassword = $request->input('password');

        $auth = Auth::guard('web')->user();
        $auth->password = Hash::make($newPassword);
        $auth->is_change_password_required = false;
        $auth->save();

        UserActivity::create([
            'user_id' => $auth->id,
            'action' => 'changed_password',
            'context' => [
                'password' => [
                    'after' => '=== SECRET ===',
                    'before' => '=== SECRET ==='
                ]
            ],
            'ip_address' => $request->ip()
        ]);

        return redirect()->route('home');
    }
}
