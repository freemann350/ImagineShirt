<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TshirtController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tshirts',[TshirtController::class, 'index'])->name('catalog');
Route::get('/tshirts/detail/{id}',[TshirtController::class, 'show'])->name('detail');
Route::view('/cart','cart');
Route::view('/checkout','checkout');

Route::get('/mgmt', [UserController::class, 'index'])->name('mgmt-home');
Route::get('/mgmt/statistics', [UserController::class, 'statistic'])->name('statistics');
Route::get('/mgmt/pending-orders', [OrderController::class, 'showPending'])->name('pending');
Route::get('/mgmt/order-history', [OrderController::class, 'showHistory'])->name('history');
Route::get('/mgmt/users', [UserController::class, 'users'])->name('users');
Route::get('/mgmt/users/edit', [UserController::class, 'usersEdit'])->name('usersEdit');