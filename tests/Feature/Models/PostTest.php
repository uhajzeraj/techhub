<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    /**
     * @test
     */
    public function itCanHaveManyTags(): void
    {
        $post = Post::factory()->create();
        $otherPost = Post::factory()->create();

        [$tag1, $tag2, $tag3] = Tag::factory(3)->create();

        DB::table('post_tags')->insert([
            ['post_id' => $post->id, 'tag_id' => $tag1->id],
            ['post_id' => $post->id, 'tag_id' => $tag2->id],
            ['post_id' => $otherPost->id, 'tag_id' => $tag2->id],
            ['post_id' => $otherPost->id, 'tag_id' => $tag3->id],
        ]);

        $this->assertCount(2, $post->tags);
        $this->assertTrue($post->tags->contains($tag1));
        $this->assertTrue($post->tags->contains($tag2));
        $this->assertFalse($post->tags->contains($tag3));
    }
}
