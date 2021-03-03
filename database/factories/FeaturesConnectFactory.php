<?php

namespace Database\Factories;

use App\Models\FeaturesConnect;
use App\Models\Feature;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeaturesConnectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeaturesConnect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'feature_id' => Feature::all()->random()->id,
            'product_id' => $this->faker->unique->randomElement(Product::get()->pluck('id')->toArray()),
            'value'      => $this->faker->word
        ];
    }

}
