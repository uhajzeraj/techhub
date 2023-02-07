<?php

namespace Tests\Feature\Models;

use App\Models\Category;
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

    /**
     * @test
     */
    public function itBelongsToACategory(): void
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);

        $this->assertTrue($post->category->is($category));
    }
}
