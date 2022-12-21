<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use Illuminate\Support\Facades\DB;

final class PostsController
{
    public function index()
    {
        $posts = DB::table('posts')->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(string $slug)
    {
        $post = DB::table('posts')
            ->where('slug', $slug)
            ->first();

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
