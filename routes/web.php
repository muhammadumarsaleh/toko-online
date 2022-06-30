<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

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

Route::get('/login', [AuthController::Class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::Class, 'authenticate']);
Route::post('/logout', [AuthController::Class, 'logout']);

Route::get('/register', [AuthController::Class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::Class, 'store'])->name('register.store');


Route::get('/', [DashboardController::Class, 'index'])->middleware('auth');
Route::get('/order/{id}', [OrderController::class, 'index']);
Route::post('/order/{id}', [OrderController::class, 'pesan']);