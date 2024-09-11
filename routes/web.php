<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Post routes
Route::resource('posts', PostController::class);

// Post management routes
Route::get('/posts/{id}/confirm-delete', [PostController::class, 'confirmDelete'])->name('posts.confirmDelete');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');

// Comment routes
Route::post('/posts/{postId}/comments', [CommentController::class, 'storeComment'])->name('comments.store');