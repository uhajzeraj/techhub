<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

final class PostsController
{
    public function index()
    {
        return view('posts.index', [
            'posts' => $this->getPostsContent(),
        ]);
    }

    public function show(string $post)
    {
        return view('posts.show');
    }

    private function getPostsContent(): array
    {
        $postsPath = storage_path('app/posts');

        $postFiles = array_diff(scandir($postsPath), ['.', '..']);

        $postsContent = [];

        foreach ($postFiles as $postFile) {
            $postsContent[] = file_get_contents("$postsPath/$postFile");
        }

        return $postsContent;
    }
}
