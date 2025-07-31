<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\AuthFormRequest;
use App\Http\Requests\Setting\InfoFormRequest;
use App\Models\Users\UserActivity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function showForm(): View
    {
        $auth = Auth::guard('web')->user();

        return view('setting', compact('auth'));
    }

    public function updateInfo(InfoFormRequest $request)
    {
        $auth = Auth::guard('web')->user();

        $beforeData = $auth->only(['last_name', 'first_name', 'email', 'language']);
        $afterData = $request->only(['last_name', 'first_name', 'email', 'language']);

        $diff = array_diff_assoc($afterData, $beforeData);

        if (!empty($diff)) {
            $auth->fill($afterData)->save();

            $activityContext = [];

            foreach ($diff as $key => $after) {
                $activityContext[$key] = [
                    'before' => $beforeData[$key],
                    'after' => $afterData[$key]
                ];
            }

            UserActivity::create([
                'user_id' => $auth->id,
                'action' => 'update_info',
                'context' => $activityContext,
                'ip_address' => $request->ip()
            ]);
        }

        return redirect()->route('setting');
    }

    public function updateAuth(AuthFormRequest $request)
    {
        $auth = Auth::guard('web')->user();

        if ($request->filled('password')) {
            $auth->password = Hash::make($request->password);
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
        }

        return redirect()->route('setting');
    }
}
