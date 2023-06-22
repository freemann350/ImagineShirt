<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\TshirtController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;

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

//GUEST ROUTES
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::get('/tshirts', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalog');
Route::get('/tshirts/detail/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('detail');

//AUTH ROUTES
Auth::routes();

//PUBLIC ROUTES
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/tshirts','catalog')->name('catalog');
    Route::get('/tshirts/detail/{id}','show')->name('detail');
    Route::get('/cart', 'cart')->name('cart');
});

Route::view('/checkout','checkout');

//ORDERS ROUTES
Route::controller(OrderController::class)->group(function () {
    Route::get('/mgmt/pending-orders/', 'showPending')->name('orders.pending');
    Route::get('/mgmt/order-history/', 'showHistory')->name('orders.history');
    Route::patch('/mgmt/orders/{order}/status','changeStatus')->name('orders.status.change');
    Route::get('/mgmt/order/view/{id}', 'show')->name('orders.show');
    Route::resource('/mgmt/order', OrderController::class);
});

//ADMINISTRATION ROUTES
Route::controller(AdminController::class)->group(function () {
    Route::get('/mgmt', 'home')->name('mgmt.home');
    Route::get('/mgmt/statistics', 'statistic')->name('statistics');
    Route::patch('/mgmt/users/{user}/blocked','changeBlock')->name('users.blocked.change');
    Route::delete('mgmt/users/{user}','destroy')->name('users.destroy');
    Route::resource('/mgmt/users',AdminController::class);
});

//CATEGORIES ROUTES
Route::controller(CategoryController::class)->group(function () {
    Route::delete('/mgmt/categories/{category}','destroy')->name('categories.destroy');
    Route::resource('/mgmt/categories',CategoryController::class);
});

//TSHIRTS ROUTES
Route::controller(TshirtController::class)->group(function () {
    Route::delete('/mgmt/tshirts/{tshirt}','destroy')->name('tshirts.destroy');
    Route::get('/mgmt/tshirts/file/{file}','getPrivateFile')->name('tshirts.get.image'); //GET FOR PRIVATE IMAGES
    Route::resource('/mgmt/tshirts',TshirtController::class);
});

//COLOR ROUTES
Route::controller(ColorController::class)->group(function () {
    Route::delete('/mgmt/colors/{color}','destroy')->name('colors.destroy');
    Route::resource('/mgmt/colors',ColorController::class);
});

//PRICE ROUTES
Route::resource('/mgmt/prices',PriceController::class)->only(['index','update']);

//STAFF PASSWORD CHANGES
Route::controller(UserController::class)->group(function () {
    Route::get('/mgmt/changepassword','changePasswordStaff')->name('staff.changePassword');
    Route::patch('/mgmt/changepassword/{user}/password','update')->name('staff.password.change');
});

//CUSTOMER ROUTES
Route::controller(CustomerController::class)->group(function () {
    Route::get('/profile/{id}','index')->name('profile');
    Route::put('/profile/{id}/editUser','updateUser')->name('updateUser');
    Route::put('/profile/{id}/editCustomer','updateCustomer')->name('updateCustomer');
});