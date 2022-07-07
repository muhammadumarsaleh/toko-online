<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
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
Route::get('/order/{id}', [OrderController::class, 'index'])->middleware('auth');
Route::post('/order/{id}', [OrderController::class, 'pesan'])->middleware('auth');

Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::delete('/checkout/{id}', [CheckoutController::class, 'delete']);
Route::get('checkout/confirm', [CheckoutController::class, 'confirm']);

Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profile', [ProfileController::class, 'update']);

Route::get('/history', [HistoryController::class, 'index']);
Route::get('/history/{id}', [HistoryController::class, 'detail']);