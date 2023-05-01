<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            //
            "user_id" => $this->faker->numberBetween(1, 10),
            "product_name" => $this->faker->sentence(3),
            "quantity" => $this->faker->numberBetween(1, 10),
            "price" => $this->faker->numberBetween(100, 1000),
            "total" => $this->faker->numberBetween(100, 1000),
            "paid" => $this->faker->boolean(),
            "delivered" => $this->faker->boolean(),
        ];
    }
}
