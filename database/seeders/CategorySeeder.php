<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'title' => 'Agriculture', 'active' => 1
        ],[
            'title' => 'DRRM', 'active' => 1
        ],[
            'title' => 'Housing', 'active' => 1
        ],[
            'title' => 'Health', 'active' => 1
        ],[
            'title' => 'Police Data', 'active' => 1
        ],[
            'title' => 'LCR', 'active' => 1
        ],[
            'title' => 'DSWD', 'active' => 1
        ])->save();
    }
}
