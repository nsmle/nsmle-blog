<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Auth\ChangeEmail;
use App\Http\Livewire\Pages\Home;
use App\Http\Livewire\Pages\Post;
use App\Http\Livewire\Pages\Profile;
use App\Http\Livewire\Pages\Dashboard;
//dd(auth()->user());
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

Route::middleware(['guest'])->group(function () {
    // Page Home
    Route::get('/', Home\Index::class)->name('home');
    
    // Page About
    Route::get('/about', fn () => "Page About")->name('about.show');
    
    // Page Post
    Route::get('/post', Post\Index::class)->name('post');
    Route::get('/post/{post}', Post\Show::class)->middleware('read-post')->name('post.view');
});



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Page Dashboard
    Route::get('/home', Dashboard\Index::class)->name('dashboard.home');
    
    
    Route::get('/dashboard', Post\Index::class)->name('dashboard');
    //Route::get('/dashboard', Post\Index::class)->name('dashboard');
    Route::get('/posts', Dashboard\Post\Index::class)->name('dashboard.post.index');
    Route::get('/posts/create', Dashboard\Post\Create::class)->name('dashboard.post.create');
    Route::get('/posts/{post}', Post\Show::class)->middleware(['read-post'])->name('dashboard.post.view');
    Route::get('/posts/{post}/edit', Dashboard\Post\Edit::class)->name('dashboard.post.edit');
    
    Route::get('/notifications', Dashboard\Notification\Index::class)->name('dashboard.notification.index');
    
    // Profile
    Route::get('/{username}/edit', Profile\Edit::class)->name('profile.edit');
});


Route::middleware(['auth:sanctum', 'auth'])->group(function () {
    Route::get('/email/change', ChangeEmail::class)->name('verification.change-email');
});

Route::get('/{user}', Profile\Show::class)->name('profile.show');

require_once __DIR__ . '/jetstream.php';