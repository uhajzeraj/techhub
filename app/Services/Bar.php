<?php

namespace App\Services;

final class Bar
{
    private Baz $baz;

    private Bat $bat;

    public function __construct(Baz $baz, Bat $bat)
    {
        $this->baz = $baz;
        $this->bat = $bat;
    }

    public function getBaz(): Baz
    {
        return $this->baz;
    }

    public function getBat(): Bat
    {
        return $this->bat;
    }
}
