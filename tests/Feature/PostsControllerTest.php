<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
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
    }
}
