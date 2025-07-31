<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\Users\UserActivity;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $userCounts = [];
        $userCountData = User::select('status', DB::raw('count(id) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        foreach (User::STATUS_LABELS as $status => $label) {
            $userCounts[] = [
                'label' => $label,
                'count' => $userCountData[$status] ?? 0
            ];
        }

        $userActivities = UserActivity::with('user')->orderBy('created_at', 'desc')->limit(10)->get();

        return view('admin.dashboard', compact('userCounts', 'userActivities'));
    }
}
