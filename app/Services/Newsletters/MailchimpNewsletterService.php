<?php

namespace App\Services\Newsletters;

use MailchimpMarketing\ApiClient;

final class MailchimpNewsletterService implements NewsletterService
{
    public function __construct(
        private readonly ApiClient $mailchimpClient,
    ) {
    }

    public function register(string $email): void
    {
    }
}
