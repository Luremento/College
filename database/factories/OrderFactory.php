<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'data' => $this->faker->data(),
            'status' => $this->faker->status(),
            'user_id' => $this->faker->user_id(),
            'place_id' => $this->faker->place_id(),
        ];
    }
}
