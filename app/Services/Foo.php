<?php

namespace App\Services;

final class Foo
{
    private Bar $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }

    public function getBar(): Bar
    {
        return $this->bar;
    }
}
