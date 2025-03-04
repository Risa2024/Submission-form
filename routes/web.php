<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('posts', [PostController::class, 'store'])->name('posts.store');//投稿データ保存用ルート
Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('posts/create', [PostController::class, 'create'])->middleware('admin')->name('posts.create');
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('post/show/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::patch('post/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
require __DIR__.'/auth.php';

//Route::get('posts/create', [PostController::class, 'create'])->middleware(['auth','admin'])->name('posts.create');