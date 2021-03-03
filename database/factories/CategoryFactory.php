<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'sub_id' => null
        ];
    }

    /*
     * Fill subcategory
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function subId()
    {
        return $this->state(function () {
            return [
                'sub_id' => $this->faker->randomElement(Category::get()->pluck('id')->toArray()),
            ];
        });
    }
}
