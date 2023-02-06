<?php

namespace App\Listeners;

use App\Events\PostWasCreatedEvent;
use App\Mail\PostWasCreated;
use App\Models\Post;
use Illuminate\Contracts\Mail\Mailer;

final class SendNotificationsToAdministrators
{
    public function __construct(
        private readonly Mailer $mailer,
    ) {
    }

    public function handle(PostWasCreatedEvent $event): void
    {
        $post = Post::query()->find($event->postId);

        $this->mailer->to($post->author->email)
            ->send(new PostWasCreated($post));
    }
}
