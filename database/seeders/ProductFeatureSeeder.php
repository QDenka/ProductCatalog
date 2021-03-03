<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FeaturesConnect;

class ProductFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 products
        FeaturesConnect::factory()
            ->count(50)
            ->create();
    }
}
