<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\Support\Str;

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
        $words = fake()->words(6, true);

        $post = Post::create([
            'author_id' => 5,
            'title' => ucfirst($words),
            'slug' => Str::slug($words),
            'excerpt' => fake()->paragraphs(3, true),
            'content' => fake()->paragraphs(8, true),
        ]);

        return redirect()->route('posts.index');
    }
}
