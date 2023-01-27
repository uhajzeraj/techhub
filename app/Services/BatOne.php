<?php

namespace App\Services;

final class BatOne implements BatInterface
{
    public function doBatStuff(): void
    {
        dump('Doing some bat stuff');
    }
}
