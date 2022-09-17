<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PostController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')
    ->group(function(){
      Route::get('members/index', [MemberController::class, 'index'])->name('members.index');
      Route::get('members/create', [MemberController::class, 'create'])->name('members.create');
      Route::post('members/', [MemberController::class, 'store'])->name('members.store');
      Route::get('members/{member}', [MemberController::class, 'edit'])->name('members.edit');
      Route::put('members/{member}', [MemberController::class, 'update'])->name('members.update');
      Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
      Route::post('posts/', [PostController::class, 'store'])->name('posts.store');
      Route::get('posts/{post}', [PostController::class, 'edit'])->name('posts.edit');
      Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
      Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
      });
