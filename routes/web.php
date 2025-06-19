<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\SearchController;
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/upload', [UploadController::class, 'index'])->name('upload');

// Menambahkan route untuk halaman explore
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');


Route::get('/', [HomeController::class, 'index'])->name('home');


// Web Routes in routes/web.php



// Menampilkan halaman upload



// Menyimpan hasil upload
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

Route::post('/posts/{id}/publish', [PostController::class, 'publish'])->name('post.publish');

Route::get('/upload', [UploadController::class, 'create'])->name('upload.create');

Route::post('/posts/{id}/publish', [PostController::class, 'publish'])->name('post.publish');


Route::resource('post', PostController::class);


Route::post('/like/{id}', [HomeController::class, 'toggleLike'])->name('like.toggle');





Route::get('/search-uploaded-images', [SearchController::class, 'searchUploadedImages'])->name('search.uploaded.images');





Route::get('/admin/login', [AdminController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'loginAdmin'])->name('admin.login.post');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logoutAdmin'])->name('admin.logout');

Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');