<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class PostsController
{
    public function index()
    {
        return view('posts');
    }

    public function show(string $post)
    {
        return view('post');
    }
}
