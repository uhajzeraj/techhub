<?php

namespace App\Services\Newsletters;

interface NewsletterService
{
    public function register(string $email): void;
}
