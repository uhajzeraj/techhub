<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class LoginControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Str::createRandomStringsUsing(fn ($length) => substr('9lm5kjC9laSDGD4B66dxfx1hw9wb4GtB2oS4399B', 0, $length));
    }

    /**
     * @test
     */
    public function itReturnsBearerTokenOnLogin(): void
    {
        // Arrange
        User::factory()->create();

        // Act
        $response = $this->get('api/login');

        // Assert
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('token', '9lm5kjC9laSDGD4B66dxfx1hw9wb4GtB2oS4399B'));
    }
}
