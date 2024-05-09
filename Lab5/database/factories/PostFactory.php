<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Creator;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>s
     */
    public function definition()
    {
        $title = $this->faker->sentence;

            return [
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => fake()->text,
                'image' => 'https://assets.materialup.com/uploads/9ffe2f61-1193-494f-97a3-d9e334335ae0/preview.jpg',
                'creator_id' => Creator::factory(),
            ];
    }
}
