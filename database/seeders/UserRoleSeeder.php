<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRoles::create([
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
