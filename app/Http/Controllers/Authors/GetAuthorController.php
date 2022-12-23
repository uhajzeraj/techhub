<?php

namespace App\Http\Controllers\Authors;

use App\Models\User;

final class GetAuthorController
{
    public function __invoke(User $author)
    {
        $author->load('posts');

        return view('authors.show', [
            'author' => $author,
        ]);
    }
}
