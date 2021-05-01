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
    Route::get('/featured_product','FeaturedProductController@featuredproduct');
    Route::get('/special_product','SpecialProductController@specialproduct');
    Route::get('/latest_product','LatestProductController@latestproduct');
    Route::get('/most_viewed_product','MostViewedProductController@mostviewproduct');
    Route::get('/best_selled_product','BestSelledProductController@bestselledproduct');
});


