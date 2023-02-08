<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class LoginControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itReturnsBearerTokenOnLogin(): void
    {
    }
}
