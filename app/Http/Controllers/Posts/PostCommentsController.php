<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Models\Comment;
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

        // The statement above does the same thing as the commented one below

        // Comment::create([
        //     ...$data,
        //     'target_type' => 'post',
        //     'target_id' => $post->id,
        //     'author_id' => $request->user()->id,
        // ]);

        return redirect()
            ->back()
            ->with('success', 'Comment was added');
    }
}
