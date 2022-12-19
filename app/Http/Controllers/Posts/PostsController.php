<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use Illuminate\Support\Facades\Storage;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

final class PostsController
{
    public function index()
    {
        $posts = $this->getPostsContent();

        usort(
            $posts,
            fn (Document $a, Document $b): int =>
            $a->matter('date') <=> $b->matter('date'),
        );

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(string $postName)
    {
        $postFile = "posts/{$postName}.html";

        if (!Storage::exists($postFile)) {
            abort(404);
        }

        $postContent = YamlFrontMatter::parse(Storage::get($postFile));

        return view('posts.show', [
            'post' => $postContent,
        ]);
    }

    /**
     * @return Document[]
     */
    private function getPostsContent(): array
    {
        $postFiles = Storage::files('posts');

        $postsContent = [];

        foreach ($postFiles as $postFile) {
            $postsContent[] = YamlFrontMatter::parse(Storage::get($postFile));
        }

        return $postsContent;
    }
}
