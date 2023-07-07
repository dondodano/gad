<?php

namespace Database\Seeders;

use App\Models\UserTempAvatar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTempAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserTempAvatar::create([
            'user_id' => 1,
            'avatar' => '<span class="avatar-initial rounded-circle bg-label-primary">SA</span>'
        ])->save();
    }
}
