<?php

namespace App\Listeners;

use App\Events\PostWasCreatedEvent;
use App\Mail\PostWasCreated;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

final class SendNotificationsToAdministrators
{
    public function handle(PostWasCreatedEvent $event): void
    {
        $post = Post::query()->find($event->postId);

        Mail::to($post->author->email)
            ->send(new PostWasCreated($post));
    }
}
