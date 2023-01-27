<?php

namespace App\Services;

final class BatTwo implements BatInterface
{
    public function doBatStuff(): void
    {
        dump('Doing some bat stuff, but differently');
    }
}
