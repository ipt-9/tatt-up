<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

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
    public function definition(): array
    {
        return [
            'user_id' =>fake(),
            'likes'=>fake()->numberBetween(0, 10000),
            'caption'=>fake()->words,
            'file_path'=>fake()->filePath(),
        ];
    }
}
