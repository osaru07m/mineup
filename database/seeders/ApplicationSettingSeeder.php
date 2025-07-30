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
        $defaultSettings = [
            //TODO - 随時追加
        ];

        foreach ($defaultSettings as $name => $value) {
            Model::create(compact('name', 'value'));
        }
    }
}
