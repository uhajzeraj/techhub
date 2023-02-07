<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
final class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'author_id' => User::factory(),
            'content' => ucfirst(fake()->words(random_int(6, 20), true)),
        ];
    }

    public function forPost(?Post $post = null): static
    {
        return $this->state(fn (array $attributes) => [
            'target_type' => 'post',
            'target_id' => $post !== null ? $post->id : Post::factory(),
        ]);
    }

    public function forAuthor(?User $user = null): static
    {
        return $this->state(fn (array $attributes) => [
            'target_type' => 'author',
            'target_id' => $user !== null ? $user->id : User::factory(),
        ]);
    }
}
