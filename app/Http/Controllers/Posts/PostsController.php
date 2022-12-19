<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use Illuminate\Support\Facades\Storage;

final class PostsController
{
    public function index()
    {
        return view('posts.index', [
            'posts' => $this->getPostsContent(),
        ]);
    }

    public function show(string $postName)
    {
        $postFile = "posts/{$postName}.html";

        if (!Storage::exists($postFile)) {
            abort(404);
        }

        $postContent = Storage::get($postFile);

        return view('posts.show', [
            'post' => $postContent,
        ]);
    }

    private function getPostsContent(): array
    {
        $postFiles = Storage::files('posts');

        $postsContent = [];

        foreach ($postFiles as $postFile) {
            $postsContent[] = Storage::get($postFile);
        }

        return $postsContent;
    }
}
