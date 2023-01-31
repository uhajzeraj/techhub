<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

final class UpdateAvatarController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:1024'],
        ]);

        $filename = $request->file('avatar')->store('avatars', 'public');

        $request->user()->update([
            'avatar' => $filename,
        ]);

        return redirect()
            ->back()
            ->with('status', 'avatar-updated');
    }
}
