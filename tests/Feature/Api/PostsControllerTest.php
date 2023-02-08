<?php

namespace Tests\Feature\Api;

use App\Models\Post;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class PostsControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itReturnsPublishedPosts(): void
    {
        $author = User::factory()->author()->create();

        [$post1, $post2] = Post::factory(2)
            ->published()
            ->create(['author_id' => $author->id]);

        $response = $this->get('api/posts');

        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->count('data', 2)
                ->where('data.0.id', $post1->id)
                ->where('data.0.author_id', $author->id)
                ->whereAllType([
                    'data.0.title' => 'string',
                    'data.0.content' => 'string',
                    'data.0.created_at' => 'string',
                ])
                ->where('data.1.id', $post2->id)
                ->where('data.1.author_id', $author->id)
                ->whereAllType([
                    'data.1.title' => 'string',
                    'data.1.content' => 'string',
                    'data.1.created_at' => 'string',
                ])
        );
    }
}
