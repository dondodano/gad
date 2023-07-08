<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::create([
            'term' => 'Super',
            'is_visible' => 0
        ],[
            'term' => 'Admin',
            'is_visible' => 1
        ],[
            'term' => 'User',
            'is_visible' => 1
        ])->save();
    }
}
