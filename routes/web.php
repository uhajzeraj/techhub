<?php

use App\Http\Controllers\Authors\GetAuthorsController;
use App\Http\Controllers\Authors\GetSingleAuthorController;
use App\Http\Controllers\Posts\PostCommentsController;
use App\Http\Controllers\Posts\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterToNewsletterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/posts');

Route::get('/newsletter', RegisterToNewsletterController::class);

Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('posts.show');

Route::get('authors', GetAuthorsController::class)->name('authors.index');
Route::get('authors/{author:username}', GetSingleAuthorController::class)->name('authors.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/posts/{post}/comments', [PostCommentsController::class, 'store'])->name('post-comments.store');
});

require __DIR__ . '/auth.php';
