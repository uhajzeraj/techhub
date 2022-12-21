<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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

    private function getPostsContent(): Collection
    {
        $postFiles = Storage::files('posts');

        $postsContent = [];

        foreach ($postFiles as $postFile) {
            $postsContent[] = $this->parsePost($postFile);
        }

        return collect($postsContent);
    }

    private function parsePost(string $fileName): Document
    {
        return YamlFrontMatter::parse(Storage::get($fileName));
    }
}
