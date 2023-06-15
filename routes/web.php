<?php

use App\Http\Controllers\TshirtController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Route::get('/tshirts',[TshirtController::class, 'index']);
Route::get('/tshirts/detail/{id}',[TshirtController::class, 'show']);
Route::view('/cart','cart');
Route::view('/checkout','checkout');