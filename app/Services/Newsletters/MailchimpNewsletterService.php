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
        $this->mailchimpClient->lists->addListMember(
            config('mailchimp.audience_list_id'),
            [
                'email_address' => $email,
                'status' => 'subscribed',
            ],
        );
    }
}
