<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 100 elements, 50 without subs, and 50 with subs
        Category::factory()
            ->count(50)
            ->subId()
            ->create();
    }
}
