<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

final class UserTest extends TestCase
{
    /**
     * @test
     */
    public function hasManyPostsIncludingUnpublished(): void
    {
        $user = User::factory()->author()->create();
        $otherUser = User::factory()->author()->create();

        [$post1, $post2, $post3] = Post::factory(3)
            ->sequence(
                ['author_id' => $user->id],
                ['author_id' => $user->id],
                ['author_id' => $otherUser->id],
            )
            ->create();

        $this->assertCount(2, $user->allPosts);
        $this->assertTrue($user->allPosts->contains($post1));
        $this->assertTrue($user->allPosts->contains($post2));
        $this->assertFalse($user->allPosts->contains($post3));
    }

    /**
     * @test
     */
    public function hasManyPublishedPosts(): void
    {
        $user = User::factory()->author()->create();
        $otherUser = User::factory()->author()->create();

        [$post1, $post2, $post3, $post4] = Post::factory(4)
            ->sequence(
                ['author_id' => $user->id, 'published_at' => now()],
                ['author_id' => $user->id, 'published_at' => now()],
                ['author_id' => $otherUser->id, 'published_at' => now()],
                ['author_id' => $user->id],
            )
            ->create();

        $this->assertCount(2, $user->posts);
        $this->assertTrue($user->posts->contains($post1));
        $this->assertTrue($user->posts->contains($post2));
        $this->assertFalse($user->posts->contains($post3));
        $this->assertFalse($user->posts->contains($post4));
    }

    /**
     * @test
     */
    public function itCanReceiveManyComments(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        [$comment1, $comment2] = Comment::factory(2)
            ->forAuthor($user)
            ->create();
        $comment3 = Comment::factory()->forPost($post)->create();

        $this->assertCount(2, $user->receivedComments);
        $this->assertTrue($user->receivedComments->contains($comment1));
        $this->assertTrue($user->receivedComments->contains($comment2));
        $this->assertFalse($user->receivedComments->contains($comment3));
    }
}
