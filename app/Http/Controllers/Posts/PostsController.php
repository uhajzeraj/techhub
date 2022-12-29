<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\Support\Str;

final class PostsController
{
    public function index()
    {
        $posts = Post::with(['author', 'tags'])
            ->wherePublished()
            ->latest('id')
            ->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show(Post $post)
    {
        $post->load(['author', 'tags']);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function store()
    {
    }
}
