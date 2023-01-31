<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

final class UpdateAvatarController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:1024'],
        ]);

        $oldFilename = $request->user()->avatar;

        $filename = $request->file('avatar')->store('avatars', 'public');

        $request->user()->update([
            'avatar' => $filename,
        ]);

        Storage::disk('public')->delete($oldFilename);

        return redirect()
            ->back()
            ->with('status', 'avatar-updated');
    }
}
