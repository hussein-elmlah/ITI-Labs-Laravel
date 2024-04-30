<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'create']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::get('/posts/create', [PostController::class, 'create']);
Route::get('/posts/{id}/edit', [PostController::class, 'edit']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
// Route::post('/posts', [PostController::class, 'store']);
// Route::put('/posts/{id}', [PostController::class, 'update']);
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/', function () {
    return view('welcome');
});
