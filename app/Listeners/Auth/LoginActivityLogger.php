<?php

namespace App\Listeners\Auth;

use App\Models\Users\UserActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;

class LoginActivityLogger
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        UserActivity::create([
            'user_id' => $user->id,
            'action' => 'login',
            'context' => json_encode([
                'user_agent' => Request::header('User-Agent'),
                'url' => Request::fullUrl(),
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'ip_address' => Request::ip(),
        ]);
    }
}
