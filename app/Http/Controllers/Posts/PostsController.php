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
        $postsPath = storage_path('app/posts');

        $postFile = "$postsPath/$postName.html";

        if (!file_exists($postFile)) {
            abort(404);
        }

        $postContent = file_get_contents($postFile);

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
