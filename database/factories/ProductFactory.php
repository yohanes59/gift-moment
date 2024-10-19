<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'name' => fake()->name,
        'image' => fake()->imageUrl(),
        'price' => fake()->numberBetween(100, 1000),
        'capital_price' => fake()->numberBetween(50, 500),
        'description' => fake()->paragraph,
        'weight' => fake()->numberBetween(1, 10),
        'stock_amount' => fake()->numberBetween(0, 100),
        'minimum_order' => fake()->numberBetween(1, 5),
        'slug' => fake()->slug,
        'deleted_at' => null,
        'created_at' => now(),
        'updated_at' => now(),
        ];
    }
}
