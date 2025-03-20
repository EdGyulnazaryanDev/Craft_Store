<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $randomImages =[
            '1.jpg',
            '2.jpg',
            '3.jpg',
            '4.jpg'
        ];

        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'image' => 'products/'.$randomImages[rand(0, 3)],
            'price' => fake()->randomDigitNotZero() * 10,
            'quantity' => fake()->randomDigitNotZero() * 10,
            'slug' => fake()->slug(),
        ];
    }
}
