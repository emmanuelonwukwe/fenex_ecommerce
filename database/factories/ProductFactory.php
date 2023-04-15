<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->word(),
            "price" => $this->faker->numberBetween(2000, 3000),
            "image" => $this->faker->imageUrl(),
            "category_id" => function(){
                return \App\Models\Category::all()->random();	
            },
        ];
    }
}
