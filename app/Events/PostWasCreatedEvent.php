<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

final class PostWasCreatedEvent
{
    use Dispatchable;

    public function __construct(
        public readonly int $postId,
    ) {
    }
}
