<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition(): array
    {
        return [
        'name' => fake()->words(4,true),
        'price' => fake()->randomFloat(2, 5, 100),
        'description' => fake()->paragraph(5,true),
        'category_id' => Category::inRandomOrder()->first()->id,
        'image' =>fake()->imageUrl(),
    ];
    }
}
