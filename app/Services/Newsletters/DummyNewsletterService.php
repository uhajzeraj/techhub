<?php

namespace App\Services\Newsletters;

final class DummyNewsletterService implements NewsletterService
{
    public function register(string $email): void
    {
    }
}
