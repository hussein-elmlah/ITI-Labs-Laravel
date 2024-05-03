<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\CommentController;
use App\Models\Post;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/posts',[PostController::class,'index'])->name('posts.index');
Route::get("/posts/create",[PostController::class,'create'])->name('posts.create');
Route::post("/posts/store",[PostController::class,'store'])->name('posts.store');
Route::get("/posts/{slug}", [PostController::class,'show'])->name('posts.show');
// Route::get("/posts/{id}", [PostController::class,'show'])->name('posts.show');
Route::get("/posts/edit/{id}", [PostController::class,'edit'])->name('posts.edit');
Route::put("/posts/update/{id}", [PostController::class,'update'])->name('posts.update');
Route::delete("/posts/delete/{id}", [PostController::class,'destroy'])->name('posts.delete');
Route::post('posts/restore-all', [PostController::class,'restoreAll'])->name('posts.restore.all');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');



// Route::get('/creators',[CreatorController::class,'index'])->name('creators.index');
// Route::get("/creators/create",[CreatorController::class,'create'])->name('creators.create');
// Route::post("/creators/store",[CreatorController::class,'store'])->name('creators.store');
// Route::get("/creators/{id}", [CreatorController::class,'show'])->name('creators.show');
// Route::get("/creators/edit/{id}", [CreatorController::class,'edit'])->name('creators.edit');
// Route::put("/creators/update/{id}", [CreatorController::class,'update'])->name('creators.update');
// Route::delete("/creators/delete/{id}", [CreatorController::class,'destroy'])->name('creators.delete');
Route::post('creators/restore-all', [CreatorController::class,'restoreAll'])->name('creators.restore.all');

// Route::resource('posts', PostController::class);
Route::resource('creators', CreatorController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
