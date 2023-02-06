<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

final class PostsControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itCanCreateANewPost(): void
    {
        // Arrange
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $author = User::factory()->author()->create();

        // Act
        $response = $this->post('/posts', [
            'category_id' => $category->id,
            'title' => 'My post title',
            'excerpt' => 'My post excerpt',
            'content' => 'This is my content and it is longer than 20 characters',
        ]);

        // Assert
        $response->assertRedirect('/posts');

        $this->assertDatabaseCount('posts', 1)
            ->assertDatabaseHas('posts', [
                'author_id' => $author->id,
                'title' => 'My post title',
                'excerpt' => 'My post excerpt',
                'content' => 'This is my content and it is longer than 20 characters',
            ]);
    }

    /**
     * @test
     */
    public function itCanDeleteAnExistingPost(): void
    {
        // Arrange
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $this->assertDatabaseCount('posts', 1)
            ->assertDatabaseHas('posts', [
                'id' => $post->id,
            ]);

        // Act
        $response = $this->delete("/posts/{$post->id}");

        // Assert
        $response->assertRedirect('/posts');

        $this->assertDatabaseCount('posts', 0)
            ->assertDatabaseMissing('posts', [
                'id' => $post->id,
            ]);
    }

    /**
     * @test
     */
    public function itCanListPublishedPosts(): void
    {
        // Arrange
        $author = User::factory()
            ->author()
            ->create(['username' => 'filan-fisteku']);

        Post::factory(2)
            ->published()
            ->state(new Sequence(
                ['title' => 'My First Post'],
                ['title' => 'My Second Post']
            ))
            ->create(['author_id' => $author->id]);

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertOk()
            ->assertViewIs('posts.index')
            ->assertSee([
                'My First Post',
                'My Second Post',
                '/authors/filan-fisteku',
            ]);
    }

    /**
     * @test
     */
    public function itDoesntListUnpublishedPosts(): void
    {
        // Arrange
        $author = User::factory()->author()->create();

        Post::factory(2)
            ->state(new Sequence(
                ['title' => 'My First Post'],
                ['title' => 'My Second Post']
            ))
            ->create(['author_id' => $author->id]);

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertOk()
            ->assertViewIs('posts.index')
            ->assertDontSee([
                'My First Post',
                'My Second Post',
            ]);
    }
}
