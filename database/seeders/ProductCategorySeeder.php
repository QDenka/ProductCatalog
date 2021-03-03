<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryConnect;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 products
        CategoryConnect::factory()
            ->count(50)
            ->create();
    }
}
