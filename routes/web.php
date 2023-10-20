<?php

use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Forum\ForumController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [PostController::class, 'index'])->middleware('auth')->name('home');

Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::get('/users/subs', 'subs')->name('users.subs');
    Route::get('/users/subs/{id}', 'store')->name('users.store');
    Route::get('/users/{id}', 'show')->name('users.show');
});

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'index')->name('profile.index');
    Route::patch('/profile/{id}', 'editProfile')->name('profile.edit');
});

Route::controller(PostController::class)->middleware('auth')->group(function () {
    Route::get('/posts', 'index')->name('posts.index');
    Route::get('/posts/create', 'create')->name('post.create');
    Route::get('/posts/delete/{id}', 'delete')->name('post.delete');
    Route::get('/posts/{id}', 'show')->name('post.show');
    Route::post('/posts', 'store')->name('post.store');
});

Route::controller(ChatController::class)->middleware('auth')->group(function () {
    Route::get('/chat', 'index')->name('chat.index');
    Route::get('/chat/create/{id}', 'createRoom')->name('chat.create');
    Route::get('/chat/{chatId}', 'room')->name('chat.room');
    Route::post('/chat/send', 'store')->name('chat.store');
});

Route::controller(ForumController::class)->middleware('auth')->group(function () {
    Route::get('/perddit', 'index')->name('forum.index');
    Route::get('/perddit/create', 'create')->name('forum.create');
    Route::get('/perddit/theme/{id}', 'show')->name('forum.show');
    Route::post('/perddit/comment', 'comment')->name('forum.comment');
    Route::post('/perddit/', 'store')->name('forum.store');
    Route::post('/perddit/reply', 'reply')->name('forum.reply');
});

Route::view('/demo-api', 'demo');

