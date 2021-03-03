<?php

namespace Database\Factories;

use App\Models\CategoryConnect;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryConnectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryConnect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::all()->random()->id,
            'product_id' => $this->faker->unique->randomElement(Product::get()->pluck('id')->toArray())
        ];
    }

}
