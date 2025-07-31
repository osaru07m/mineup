<?php

namespace Database\Seeders;

use App\Models\ApplicationSetting as Model;
use Illuminate\Database\Seeder;

class ApplicationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var array<string, string> */
        $defaultSettings = [
            'is_guest_registration_allowed' => '1',
        ];

        foreach ($defaultSettings as $name => $value) {
            Model::create(compact('name', 'value'));
        }
    }
}
