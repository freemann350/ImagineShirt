<?php

use App\Http\Controllers\AdminController;
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
//PUBLIC ROUTES
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/tshirts','catalog')->name('catalog');
    Route::get('/tshirts/detail/{id}','show')->name('detail');
});


Route::view('/cart','cart');
Route::view('/checkout','checkout');

//ORDERS ROUTES
Route::controller(OrderController::class)->group(function () {
    Route::get('/mgmt/pending-orders/', 'showPending')->name('orders.pending');
    Route::get('/mgmt/order-history/', 'showHistory')->name('orders.history');
    Route::get('/mgmt/order/view/{id}', 'show')->name('orders.show');
});

//ADMINISTRATION ROUTES
Route::controller(AdminController::class)->group(function () {
    Route::get('/mgmt', 'home')->name('mgmt.home');
    Route::get('/mgmt/statistics', 'statistic')->name('statistics');
    //Route::get('/mgmt/users', 'users')->name('users');
    //Route::get('/mgmt/users/{id}/edit', 'userEdit')->name('users.edit');
    //Route::put('/mgmt/users/{id}', 'update')->name('users.update');
    Route::resource('/mgmt/users',AdminController::class);
});