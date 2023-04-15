<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    private function fakeRole(){
        $num = mt_rand(0, 1);

        return $num == 0 ? "user" : "admin";
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->email(),
            'role' => $this->fakeRole(),
            'email_verified_at' => now(),
            'password' => '$2y$10$f7OPMOEar1g/qEs7iU47/eh8yOoSQPAePkTbjDO1xIBRQ5uy9Iuq2', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
