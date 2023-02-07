<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

final class PostTest extends TestCase
{
    /**
     * @test
     */
    public function itBelongsToAnAuthor(): void
    {
        $author = User::factory()->author()->create();
        $post = Post::factory()->create(['author_id' => $author->id]);

        $this->assertTrue($post->author->is($author));
    }
}
