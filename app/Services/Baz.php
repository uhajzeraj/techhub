<?php

namespace App\Services;

final class Baz
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }
}
