<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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


Route::get('/', function () {
    return redirect()->route('posts.index');
});


Route::get('/posts/prune-old', [PostController::class, 'pruneOldPosts'])->name('posts.pruneOld');
Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::get('/posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');
Route::get('/posts/force-delete/{post}', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);
Route::post('posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
