<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            return [
                'title' => fake()->word,
                'description' => fake()->paragraph,
                'author' => fake()->name,
                'image' => 'https://assets.materialup.com/uploads/9ffe2f61-1193-494f-97a3-d9e334335ae0/preview.jpg',
            ];
    }
}
