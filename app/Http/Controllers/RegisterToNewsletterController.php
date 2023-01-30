<?php

namespace App\Http\Controllers;

use App\Services\Newsletters\NewsletterService;
use Illuminate\Http\Request;

final class RegisterToNewsletterController
{
    public function __construct(
        private readonly NewsletterService $newsletterService,
    ) {
    }

    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $this->newsletterService->register($data['email']);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Added to newsletter');
    }
}
