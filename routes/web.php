<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MessageController::class, 'index'])->name('homepage');

Route::get('search', [MessageController::class, 'index'])->name('search');

Route::resource('message', MessageController::class)->middleware('auth');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update')->middleware('auth');

Route::get('/user/login', [LoginController::class, 'login'])->name('user.login');
Route::post('/user/login', [LoginController::class, 'loginProcess'])->name('user.loginProcess');
Route::get('/user/logout', [LoginController::class, 'logout'])->name('user.logout');
