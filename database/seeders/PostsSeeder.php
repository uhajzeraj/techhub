<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

final class PostsSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(10)->create();
    }
}
