<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categories = [
            [
                'name' => 'Pizza',
                'description' => 'All kinds of pizza',
                'image' => fake()->imageUrl(640, 480, 'food'),
            ],
            [
                'name' => 'Burger',
                'description' => 'Delicious burgers',
                'image' => fake()->imageUrl(640, 480, 'food'),
            ],
            [
                'name' => 'Drinks',
                'description' => 'Cold and hot drinks',
                'image' => fake()->imageUrl(640, 480, 'food'),
            ],
            [
                'name' => 'Desserts',
                'description' => 'Sweet desserts',
                'image' => fake()->imageUrl(640, 480, 'food'),
            ],
        ];

        Category::insert($categories);
    }
}
