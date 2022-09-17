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
    ->prefix('members')
    ->group(function(){
      Route::get('/index', [MemberController::class, 'index'])->name('members.index');
      Route::get('/create', [MemberController::class, 'create'])->name('members.create');
      Route::post('/', [MemberController::class, 'store'])->name('members.store');
      Route::get('/{member}', [MemberController::class, 'edit'])->name('members.edit');
      Route::put('/{member}', [MemberController::class, 'update'])->name('members.update');
      });

Route::prefix('posts')
    ->middleware('auth')
    ->group(function(){
      Route::get('/create', [PostController::class, 'create'])->name('posts.create');
      Route::post('/', [PostController::class, 'store'])->name('posts.store');
      Route::get('/{post}', [PostController::class, 'edit'])->name('posts.edit');
      Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
      Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });