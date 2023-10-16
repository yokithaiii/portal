<?php

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(\App\Http\Controllers\Users\UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::get('/users/subs', 'subs')->name('users.subs');
    Route::get('/users/subs/{id}', 'store')->name('users.store');
    Route::get('/users/{id}', 'show')->name('users.show');
});

Route::controller(\App\Http\Controllers\Profile\ProfileController::class)->group(function () {
    Route::get('/profile', 'index')->name('profile.index');
    Route::patch('/profile/{user}', 'editProfile')->name('profile.edit');
});

Route::controller(\App\Http\Controllers\Posts\PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('posts.index');
    Route::get('/posts/create', 'create')->name('post.create');
    Route::get('/posts/update/{post}', 'update')->name('post.update');
    Route::get('/posts/delete/{post}', 'delete')->name('post.delete');
    Route::get('/posts/{post}', 'show')->name('post.show');
    Route::post('/posts', 'store')->name('post.store');
    Route::post('/posts/like/{post}', 'like')->name('post.like');
});

Route::controller(\App\Http\Controllers\Chat\ChatController::class)->group(function () {
    Route::get('/chat', 'index')->name('chat.index');
    Route::get('/chat/roomCreate={id}', 'createRoom')->name('chat.create');
    Route::get('/chat/{chatId}', 'room')->name('chat.room');
    Route::post('/chat/send', 'store')->name('chat.store');
});
