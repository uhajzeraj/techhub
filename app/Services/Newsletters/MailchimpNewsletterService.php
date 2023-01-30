<?php

namespace App\Services\Newsletters;

use MailchimpMarketing\ApiClient;

final class MailchimpNewsletterService implements NewsletterService
{
    public function __construct(
        private readonly ApiClient $mailchimpClient,
        private readonly string $audienceListId,
    ) {
    }

    public function register(string $email): void
    {
        $this->mailchimpClient->lists->addListMember(
            $this->audienceListId,
            [
                'email_address' => $email,
                'status' => 'subscribed',
            ],
        );
    }
}
