<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Models\Post;

final class PostsController
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function store()
    {
    }
}
