<?php

namespace Tests\Feature\Models;

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
}
