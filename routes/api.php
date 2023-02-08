<?php

use App\Http\Controllers\Api\Posts\PostsController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostsController::class, 'index']);

// This is insecure, do not use it in production without checking credentials
Route::get('login', function () {
    /** @var User $user */
    $user = User::firstOrFail();

    $token = $user->createToken("Urani's iPhone - iPhone 12");

    return ['token' => $token->plainTextToken];
});
