<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\Request;

final class UpdateAvatarController
{
    public function __construct(
        private readonly FilesystemAdapter $filesystem,
    ) {
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:1024'],
        ]);

        $oldFilename = $request->user()->avatar;

        $filename = $this->filesystem->putFile('avatars', $request->file('avatar'));

        $request->user()->update([
            'avatar' => $filename,
        ]);

        $this->filesystem->delete($oldFilename);

        return redirect()
            ->back()
            ->with('status', 'avatar-updated');
    }
}
