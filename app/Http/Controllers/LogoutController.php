<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

final class LogoutController
{
    public function __invoke()
    {
        Auth::logout();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Logged out');
    }
}
