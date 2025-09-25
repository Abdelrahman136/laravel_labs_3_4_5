<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {
        return redirect()->route('posts.index');
    });

    Route::get('/posts/prune-old', [PostController::class, 'pruneOldPosts'])->name('posts.pruneOld');
    Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed')->middleware('admin.only');
    Route::get('/posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('/posts/force-delete/{post}', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::resource('posts', PostController::class);
    Route::get('/admin/users', [AdminController::class, 'usersList'])->name('admin.users.index')->middleware('admin.only');
    Route::patch('/admin/users/{id}/changeRole', [AdminController::class, 'changeUserRole'])->name('admin.users.changeRole')->middleware('admin.only');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy')->middleware('admin.only');
    Route::post('posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
});

require __DIR__ . '/auth.php';
