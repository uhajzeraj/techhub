<?php

namespace Tests\Feature;

use App\Events\PostWasCreatedEvent;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

final class PostsControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
    }

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

        Event::assertDispatched(function (PostWasCreatedEvent $event) {
            return $event->postId === Post::first()->id;
        });
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

    /**
     * @test
     */
    public function itFiltersBySearchTerm(): void
    {
        // Arrange
        $author = User::factory()->author()->create(['name' => 'Filan Fisteku the III']);
        $category = Category::factory()->create();

        Post::factory(4)
            ->published()
            ->state(new Sequence(
                ['slug' => 'post-1', 'title' => 'This title contains filan fisteku in it'],
                ['slug' => 'post-2', 'content' => 'This content contains filan fisteku in it as well'],
                ['slug' => 'post-3', 'author_id' => $author->id],
                ['slug' => 'post-4'],
            ))
            ->create(['category_id' => $category->id]);

        // Act
        $response = $this->get('/posts?search=filan%20fisteku');

        // Assert
        $response->assertOk()
            ->assertViewIs('posts.index')
            ->assertSee([
                '/posts/post-1',
                '/posts/post-2',
                '/posts/post-3',
            ])
            ->assertDontSee('/posts/post-4');
    }

    /**
     * @test
     */
    public function itFiltersByCategory(): void
    {
        [$category1, $category2] = Category::factory(2)->create();

        Post::factory(2)
            ->published()
            ->state(new Sequence(
                ['slug' => 'post-1', 'category_id' => $category1->id],
                ['slug' => 'post-2', 'category_id' => $category2->id],
            ))
            ->create();

        $response = $this->get("/posts?category={$category1->id}");

        $response->assertOk()
            ->assertViewIs('posts.index')
            ->assertSee('/posts/post-1')
            ->assertDontSee('/posts/post-2');
    }

    /**
     * @test
     */
    public function itPaginatesPosts(): void
    {
        $category = Category::factory()->create();

        Post::factory(6)
            ->published()
            ->state(new Sequence(
                ['slug' => 'post-1'],
                ['slug' => 'post-2'],
                ['slug' => 'post-3'],
                ['slug' => 'post-4'],
                ['slug' => 'post-5'],
                ['slug' => 'post-6'],
            ))
            ->create(['category_id' => $category->id]);

        // Sorted DESC by id
        $this->get('/posts?page=1')
            ->assertOk()
            ->assertViewIs('posts.index')
            ->assertSee([
                '/posts/post-6',
                '/posts/post-5',
                '/posts/post-4',
                '/posts/post-3',
                '/posts/post-2',
            ])
            ->assertDontSee('/posts/post-1');

        $this->get('/posts?page=2')
            ->assertOk()
            ->assertViewIs('posts.index')
            ->assertSee('/posts/post-1')
            ->assertDontSee([
                '/posts/post-6',
                '/posts/post-5',
                '/posts/post-4',
                '/posts/post-3',
                '/posts/post-2',
            ]);
    }
}
