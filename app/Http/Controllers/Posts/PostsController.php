<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
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
        $categories = Category::all();

        return view('posts.create', [
            'categories' => $categories,
        ]);
    }

    public function show(Post $post)
    {
        $post->load(['author', 'tags']);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function store(Request $request)
    {
        $title = $request->post('title');
        $excerpt = $request->post('excerpt');
        $content = $request->post('content');
        $categoryId = $request->post('category_id');

        $post = new Post();

        $post->title = $title;
        $post->slug = fake()->slug();
        $post->excerpt = $excerpt;
        $post->content = $content;
        $post->category_id = $categoryId;
        $post->author_id = User::where('role', 'author')->first()->id;

        $post->save();

        return redirect()->route('posts.index');
    }
}
