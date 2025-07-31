<?php

namespace Database\Seeders;

use App\Models\Users\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'login' => 'admin',
            'email' => 'example@mineup.app',
            'password' => Hash::make('admin'),
            'first_name' => '管理者',
            'last_name' => config('app.name'),
            'is_change_password_required' => true,
            'is_admin' => true
        ]);
    }
}
