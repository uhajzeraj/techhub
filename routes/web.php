<?php

use App\Http\Controllers\Authors\GetAuthorsController;
use App\Http\Controllers\Authors\GetSingleAuthorController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Posts\PostsController;
use App\Http\Controllers\Register\RegisterController;
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

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/logout', LogoutController::class)->name('logout');

Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
Route::get('/posts/{post:slug}', [PostsController::class, 'show'])->name('posts.show');

Route::get('authors', GetAuthorsController::class)->name('authors.index');
Route::get('authors/{author:username}', GetSingleAuthorController::class)->name('authors.show');
