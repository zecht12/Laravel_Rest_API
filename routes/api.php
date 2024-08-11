<?php

use App\Http\Middleware\OwnerPost;
use App\Http\Middleware\OwnerComment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware(OwnerPost::class);
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware(OwnerPost::class);

    Route::post('/comments', [CommentController::class, 'store']);
    Route::patch('/comments/{id}', [CommentController::class, 'update'])->middleware(OwnerComment::class);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware(OwnerComment::class);

    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
});
