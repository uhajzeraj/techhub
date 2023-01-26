<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Post;

final class PostsController
{
    public function index()
    {
        return response()->json(
            Post::query()
                ->wherePublished()
                ->get()
        );
    }
}
