<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users\UserActivity;
use Illuminate\Contracts\View\View;

class ActivityController extends Controller
{
    public function index(): View
    {
        $activities = UserActivity::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.activities', compact('activities'));
    }
}
