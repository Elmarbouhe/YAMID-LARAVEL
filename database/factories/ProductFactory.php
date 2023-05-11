<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
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
            "title" => $title = $this->faker->sentence(3),
            "slug" => Str::slug($title),
            "description" => $this->faker->paragraph(1),
            "price" => $this->faker->numberBetween(100, 1000),
            "old_price" => $this->faker->numberBetween(100, 1000),
            "inStock" => $this->faker->numberBetween(0, 10),
            "category_id" => $this->faker->numberBetween(1, 10),
            "image" => $this->faker->imageUrl(640, 480, "animals", true),
        ];
    }
}
