<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;

final class PostCommentsController
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content' => ['required', 'min:1'],
        ]);

        $post->comments()->create([
            'author_id' => $request->user()->id,
            ...$data,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Comment was added');
    }
}
