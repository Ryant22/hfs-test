<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;
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

Route::get('/', function () {
    return view('welcome', ['posts' => App\Models\Post::latest()->paginate(3)]);
})->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/posts/create', [BlogPostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [BlogPostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [BlogPostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}/update', [BlogPostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}/delete', [BlogPostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/posts/{postId}/comments/{commentId}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/posts', [BlogPostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [BlogPostController::class, 'show'])->name('posts.show');
