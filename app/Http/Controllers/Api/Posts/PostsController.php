<?php

namespace App\Http\Controllers\Api\Posts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

final class PostsController
{
    public function index()
    {
        $posts = Post::query()
            ->wherePublished()
            ->get();

        $postResponse = $posts->map(
            fn (Post $post) =>
            [
                'id' => $post->id,
                'author_id' => $post->author_id,
                'title' => $post->title,
                'content' => $post->content,
                'created_at' => $post->created_at,
            ]
        );
        return response()->json($postResponse);
    }
}
