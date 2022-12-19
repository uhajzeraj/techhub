<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

final class PostsController
{
    public function index()
    {
        $posts = $this->getPostsContent()
            ->sort(
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

        $postContent = Cache::rememberForever($postFile, function () use ($postFile) {
            if (!Storage::exists($postFile)) {
                abort(404);
            }

            return YamlFrontMatter::parse(Storage::get($postFile));
        });

        return view('posts.show', [
            'post' => $postContent,
        ]);
    }

    private function getPostsContent(): Collection
    {
        $postFiles = Storage::files('posts');

        $postsContent = [];

        foreach ($postFiles as $postFile) {
            $postsContent[] = YamlFrontMatter::parse(Storage::get($postFile));
        }

        return collect($postsContent);
    }
}
