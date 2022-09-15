<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware('auth')
    ->group(function(){
      Route::get('members/index', [MemberController::class, 'index'])->name('members.index');
      Route::get('members/create', [MemberController::class, 'create'])->name('members.create');
      Route::post('members/', [MemberController::class, 'store'])->name('members.store');
      Route::get('members/{member}', [MemberController::class, 'edit'])->name('members.edit');
      Route::put('members/{member}', [MemberController::class, 'update'])->name('members.update');
      });
