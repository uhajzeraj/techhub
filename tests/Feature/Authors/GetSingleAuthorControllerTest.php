<?php

namespace Tests\Feature\Authors;

use App\Models\User;
use Tests\TestCase;

final class GetSingleAuthorControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itCanShowASingleAuthor(): void
    {
        User::factory()->author()->create([
            'username' => 'filan fisteku',
            'name' => 'Filan Fisteku',
        ]);

        $this->get('/authors/filan%20fisteku')
            ->assertOk()
            ->assertViewIs('authors.show')
            ->assertSee([
                'Filan Fisteku',
            ]);
    }
}
