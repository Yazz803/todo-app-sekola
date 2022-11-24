<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->middleware('isGuest')->name('login.index');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'isLogin'], function () {
    // Route::resource('/todo', TodoController::class);
    Route::get('/dashboard', [TodoController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/create', [TodoController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard', [TodoController::class, 'store'])->name('dashboard.store');
    Route::delete('/dashboard/{todo:id}', [TodoController::class, 'destroy'])->name('dashboard.destroy');
    Route::put('/dashboard/{todo:id}', [TodoController::class, 'update'])->name('dashboard.update');
    Route::put('/dashboard/update/{todo:id}', [TodoController::class, 'updateStatus'])->name('dashboard.updateStatus');
    Route::get('/dashboard/edit/{todo:id}', [TodoController::class, 'edit'])->name('dashboard.edit');
});