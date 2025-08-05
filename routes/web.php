<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Guest routes (only accessible when not logged in)
// Route::middleware('guest')->group(function () {

// });
Route::get('/', [LandingPageController::class, 'index'])->name('welcome');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/blog', [PostController::class, 'index'])->name('post.index');
Route::get('/blog/{id}', [PostController::class, 'show'])->name('post.show');
Route::post('/blog/{id}/comments', [CommentController::class, 'store'])->name('comments.store');

// Authenticated routes (only accessible when logged in)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('roles', RoleController::class);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/blog/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/blog', [PostController::class, 'store'])->name('post.store');
    Route::get('/blog/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/blog/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/blog/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});
