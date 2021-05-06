<?php

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
Route::get('/', 'Backend\Auth\AuthController@index')->name('login');
//Route::namespace('Frontend')->group(function () {
//
//    /*.................................Home Controller.............................................*/
//    Route::get('/about-us', 'HomeController@aboutus');
//    Route::get('/contact-us', 'HomeController@contactus');
//    Route::get('/shop', 'HomeController@shop');
//    Route::get('/shop-item/{slug}', 'HomeController@shopsingle');
//    Route::get('/category/{id}', 'HomeController@category');
//    Route::get('/product/sorting','HomeController@sorting')->name('sorting');
//    Route::get('/search', 'HomeController@searchinput')->name('searchinput');
//
//
//    /*...........................User Controller...................................*/
//    Route::post('/register', 'UserController@store');
//    Route::post('user/login', 'LoginController@login');
//    Route::get('user/logout','LoginController@logout');
//    Route::get('/account', 'UserController@account');
//
//    /*...........................Comment Controller...................................*/
//    Route::post('/review/create', 'ReviewController@create')->middleware('login.check');
//    Route::get('/review/delete/{id}', 'ReviewController@delete')->middleware('login.check');
//
//
//
//    /*............................Cart Controller.......................................*/
//    Route::get('/cart', 'CartController@index');
//    Route::post('/delete_cart_item', 'CartController@deleteCartItem');
//    Route::post('/update_cart', 'CartController@updateCart');
//    Route::post('/add-to-cart', 'CartController@store');
//
//    /*............................Checkout Controller...................................*/
//    Route::get('/checkout','CheckoutController@index');
//    Route::post('/checkout/details','CheckoutController@getCheckoutDetails')->name('checkout.details');
//    Route::get('/checkout/success','CheckoutController@getExpressCheckoutSuccess');
//
//    /*............................OrderTracking Controller...................................*/
//    Route::get('trackorder','OrderController@trackingIndex')->name('order.tracking');
//    Route::post('order/tracking/','OrderController@orderTracking');
//
//
//});
//
//
//Auth::routes(['verify' => true]);
//
//Route::middleware(['auth:web', 'verified'])->group(function () {
//    Route::get('/account', 'Frontend\UserController@account');
//});

