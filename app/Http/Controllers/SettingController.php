<?php

namespace App\Http\Controllers;

use App\Http\Requests\Setting\InfoFormRequest;
use App\Models\Users\UserActivity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function showForm(): View
    {
        $user = Auth::guard('web')->user();

        return view('setting', compact('user'));
    }

    public function updateInfo(InfoFormRequest $request)
    {
        $user = Auth::guard('web')->user();

        $beforeData = $user->only(['last_name', 'first_name', 'email', 'language']);
        $afterData = $request->only(['last_name', 'first_name', 'email', 'language']);

        $diff = array_diff_assoc($afterData, $beforeData);

        if (!empty($diff)) {
            $user->fill($afterData)->save();

            $activityContext = [];

            foreach ($diff as $key => $after) {
                $activityContext[$key] = [
                    'before' => $beforeData[$key],
                    'after' => $afterData[$key]
                ];
            }

            UserActivity::create([
                'user_id' => $user->id,
                'action' => 'update_info',
                'context' => $activityContext,
                'ip_address' => $request->ip()
            ]);
        }

        return redirect()->route('setting');
    }
}
