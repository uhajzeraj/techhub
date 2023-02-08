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

        $response
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) => $json
                    ->has('data', 2)
                    ->where('data.0.id', $post1->id)
                    ->where('data.0.author_id', $author->id)
                    ->where('data.1.id', $post2->id)
                    ->where('data.1.author_id', $author->id)
                    ->has('data', fn (AssertableJson $json) => $json->each(
                        fn (AssertableJson $json) => $json->whereAllType([
                            'id' => 'integer',
                            'author_id' => 'integer',
                            'title' => 'string',
                            'content' => 'string',
                            'created_at' => 'string',
                        ])
                    ))
            );
    }

    /**
     * @test
     */
    public function itDoesntReturnUnpublishedPosts(): void
    {
        Post::factory(2)->create();

        $this->get('api/posts')
            ->assertOk()
            ->assertJson(
                fn (AssertableJson $json) => $json->has('data', 0),
            );
    }
}
