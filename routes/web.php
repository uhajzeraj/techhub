<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Posts\PostsController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
