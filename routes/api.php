<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*Login Controller*/
Route::namespace('Api')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::get('/site-setting', 'SiteController@index');
    Route::get('/banners', 'BannerController@banner');
    Route::get('/featured_product','ProductController@featuredproduct');
    Route::get('/special_product','ProductController@specialproduct');
    Route::get('/latest_product','ProductController@latestproduct');
    Route::get('/most_viewed_product','ProductController@mostviewproduct');
    Route::get('/best_selled_product','ProductController@bestselledproduct');
    Route::get('/product/{slug}','ProductController@ProductDetail');
    Route::get('/category', 'CategoryController@categories');
    Route::get('/latest_category', 'CategoryController@latestcategory');
    Route::middleware('auth:api')->group(function(){
        Route::get('/cart','CartController@index');
        Route::post('/add-to-cart','CartController@Store');
        Route::delete('carts/{id}', 'CartController@delete');
        Route::post('/checkout','CheckoutController@store');
        Route::post('/review','ReviewController@store');
        Route::delete('/review/{id}','ReviewController@delete');
        Route::get('/wish_list','WishlistController@index');
        Route::post('/add_to_wish_list','WishlistController@Store');
        Route::delete('wish_lists/{id}', 'WishlistController@delete');
    });
    Route::get('/review','reviewController@index');
    Route::post('/search','SearchController@search');


});


