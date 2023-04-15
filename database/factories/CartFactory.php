<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => function(){
                return \App\Models\User::all()->random();	
            },

            "product_id" => function(){
                return \App\Models\Product::all()->random();	
            },

            'quantity' => $this->faker->numberBetween(1, 10)
        ];
    }
}
