<?php

namespace Database\Seeders;

use App\Models\SettingGeneral;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingGeneral::create([
            'site_title' => 'GAD-DB',
            'site_definition' => 'Gender and Development Database',
            'entity_name' => 'DILG',
            'entity_definition' => 'Department of Interior Local Government',
            'web_icon' => '/images/default_logo.png'
        ]);
    }
}
