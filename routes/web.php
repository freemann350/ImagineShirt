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
use App\Http\Controllers\CartController;

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

Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'show')->name('cart');
    Route::get('/cart/checkout', 'checkout')->name('checkout');
    Route::post('/cart/add/{tshirt}', 'addToCart')->name('cart.add');
    Route::delete('/cart/{item}/remove', 'removeFromCart')->name('cart.remove');
    Route::post('/cart/store', 'store')->name('cart.store');
});

//AUTH ROUTES
Auth::routes();

//PUBLIC ROUTES
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/tshirts','catalog')->name('catalog');
    Route::get('/tshirts/detail/{id}','show')->name('detail');
});

Route::middleware('employee')->group(function () {
    Route::get('/mgmt', [AdminController::class,'home'])->name('mgmt.home');

    //ORDERS ROUTES
    Route::controller(OrderController::class)->group(function () {
        Route::get('/mgmt/pending-orders/', 'showPending')->name('orders.pending');
        Route::patch('/mgmt/orders/{order}/status','changeStatus')->name('orders.status.change');
        Route::get('/mgmt/order/view/{id}', 'show')->name('orders.show');
        Route::resource('/mgmt/order', OrderController::class);
    });
});

//ADMINISTRATION ROUTES
Route::middleware('admin')->group(function () {
    //ORDER HISTORY (ADMIN SPECIFIC)
    Route::get('/mgmt/order-history/', [OrderController::class,'showHistory'])->name('orders.history');

    Route::controller(AdminController::class)->group(function () {
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
        Route::get('/file/{file}','getPrivateFile')->name('tshirts.get.image'); //GET FOR PRIVATE IMAGES
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
});

//CUSTOMER ROUTES
Route::controller(CustomerController::class)->group(function () {
    Route::get('/profile/{user}','index')->name('profile');
    Route::get('/profile/{user}/orders','orders')->name('orders');
    Route::get('/profile/{user}/orders/view/{id}', 'showOrder')->name('showOrder');
    Route::get('/profile/{user}/upload','upload')->name('upload');
    Route::put('/profile/{user}/editUser','updateUser')->name('updateUser');
    Route::put('/profile/{customer}/editCustomer','updateCustomer')->name('updateCustomer');
    Route::put('/profile/{user}/uploadImage','uploadImage')->name('uploadImage');
    Route::delete('/profile/{tshirt}/removeImage','removeImage')->name('removeImage');
    Route::get('/cart/{id}/pdf', [CartController::class, 'createPDF']); //PRECISO MUDAR DE LOCAL
    Route::put('/profile/{customer}/editCustomerCheckout','updateCustomerCheckout')->name('updateCustomerCheckout');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');
});
