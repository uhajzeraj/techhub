<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'excerpt' => ['required', 'string', 'min:5'],
            'content' => ['required', 'string', 'min:20'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $validator->validate();

        $data = array_merge($validator->validated(), [
            'slug' => fake()->slug(),
            'author_id' => User::where('role', 'author')->first()->id,
        ]);
        
        Post::create($data);

        return redirect()->route('posts.index');
    }
}
