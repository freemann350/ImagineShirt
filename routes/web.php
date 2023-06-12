<?php

use App\Http\Controllers\TshirtController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/detail','detail');
Route::get('/shop',[TshirtController::class, 'index']);
Route::view('/cart','cart');
Route::view('/checkout','checkout');