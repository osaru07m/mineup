<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Models\Users\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterFormRequest $request)
    {
        $credentials = $request->only(['login', 'password', 'last_name', 'first_name', 'email', 'language']);

        $credentials['status'] = User::STATUS_PENDING;
        $credentials['password'] = Hash::make($credentials['password']);

        User::create($credentials);

        return back()->with('success', true);
    }
}
