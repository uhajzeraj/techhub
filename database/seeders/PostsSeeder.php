<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

final class PostsSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(10)->create([
            'author_id' => User::factory()->create(),
        ]);
    }
}
