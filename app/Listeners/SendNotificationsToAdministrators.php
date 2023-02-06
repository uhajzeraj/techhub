<?php

namespace App\Listeners;

use App\Events\PostWasCreatedEvent;
use App\Models\Post;

final class SendNotificationsToAdministrators
{
    public function handle(PostWasCreatedEvent $event): void
    {
        $post = Post::query()->find($event->postId);
    }
}
