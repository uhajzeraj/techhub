<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition()
    {
        return [
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'slug' => fake()->slug(),
            'title' => ucfirst(fake()->words(6, true)),
            'excerpt' => fake()->paragraphs(3, true),
            'content' => fake()->paragraphs(8, true),
        ];
    }
}
