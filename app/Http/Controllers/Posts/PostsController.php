<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

final class PostsController
{
    public function index()
    {
        $postsPath = storage_path('app/posts');

        $postFiles = array_diff(scandir($postsPath), ['.', '..']);

        $postsContent = [];

        foreach ($postFiles as $postFile) {
            $postsContent[] = file_get_contents("$postsPath/$postFile");
        }

        return view('posts.index');
    }

    public function show(string $post)
    {
        return view('posts.show');
    }
}
