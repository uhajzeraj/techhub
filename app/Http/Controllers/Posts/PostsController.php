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

    public function show(Post $post)
    {
        $post->load(['author', 'tags']);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function store()
    {
        $words = fake()->words(6, true);

        Post::create([
            'author_id' => 5,
            'title' => ucfirst($words),
            'slug' => Str::slug($words),
            'excerpt' => fake()->paragraphs(3, true),
            'content' => fake()->paragraphs(8, true),
        ]);

        return redirect()->route('posts.index');
    }
}
