<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Post;

final class PostsController
{
    public function index()
    {
        return Post::query()
            ->wherePublished()
            ->get();
    }
}
