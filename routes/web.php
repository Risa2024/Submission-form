<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RateLimitMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // store アクション以外のリソースルート
    Route::resource('posts', PostController::class)->except('store');
    
    // store アクションのみ別途定義してレートリミットを適用
    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.store')
        ->middleware(RateLimitMiddleware::class);
});

require __DIR__.'/auth.php';

//Route::get('posts/create', [PostController::class, 'create'])->middleware(['auth','admin'])->name('posts.create');