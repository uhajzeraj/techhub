<?php

namespace App\Http\Controllers\Authors;

use App\Models\User;

final class GetAuthorsController
{
    public function __invoke()
    {
        $authors = User::query()
            ->where('role', 'author')
            ->get();

        return view('authors.index', [
            'authors' => $authors,
        ]);
    }
}
