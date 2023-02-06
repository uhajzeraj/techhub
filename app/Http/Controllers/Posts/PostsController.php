<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Mail\PostWasCreated;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\Foo;
use App\Services\Mat;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

final class PostsController
{
    public function __construct(
        private readonly Foo $foo,
        private readonly Mat $mat,
        private readonly Dispatcher $eventDispatcher,
    ) {
    }

    public function index(Request $request)
    {
        $posts = Post::with(['author', 'tags', 'category'])
            ->wherePublished()
            ->filterBySearchTerm($request->get('search'))
            ->filterByCategory($request->get('category'))
            ->latest('posts.id')
            ->simplePaginate(5)
            ->withQueryString();

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
        $post->load([
            'author',
            'tags',
            'comments.author',
        ]);

        // comments.author can also be written as:
        // 
        // $post->load([
        //     'comments' => function ($query) {
        //         $query->with('author');
        //     },
        // ]);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'excerpt' => ['required', 'string', 'min:5'],
            'content' => ['required', 'string', 'min:20'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $data = array_merge($data, [
            'slug' => fake()->slug(),
            'author_id' => User::where('role', 'author')->first()->id,
        ]);

        $post = Post::create($data);

        Mail::to($post->author->email)
            ->send(new PostWasCreated($post));

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post was successfully created!');
    }
}
