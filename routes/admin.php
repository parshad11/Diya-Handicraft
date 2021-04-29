<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->prefix('auth')->group(function () {
    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout')->name('logout');
});

Route::group(['middleware' => 'auth:admin'], function () {
    //.............................Dashboard Controller.........................................//
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');

    //...............................Admin Controller....................................................//
    Route::name('admins.')->prefix('user')->group(function () {
        Route::get('/', 'AdminController@index')->name('list');
        Route::get('/create', 'AdminController@create')->name('create');
        Route::post('/', 'AdminController@store')->name('store');
        Route::get('/{id}/show', 'AdminController@show')->name('show');
        Route::get('user/{id}/show', 'AdminController@userShow')->name('user.show');
        Route::get('/{id}/edit', 'AdminController@edit')->name('edit');
        Route::patch('/{id}', 'AdminController@update')->name('update');
        Route::get('user/{id}/edit', 'AdminController@userEdit')->name('user.edit');
        Route::patch('user/{id}', 'AdminController@userUpdate')->name('user.update');
        Route::delete('/{id}', 'AdminController@destroy')->name('destroy');
        Route::delete('user/{id}', 'AdminController@userDestroy')->name('user.destroy');
        Route::post('/set-order', 'AdminController@setOrder')->name('setOrder');
    });

    //................................Site Controller...................................................//

    Route::get('/site-setting', 'SettingController@index')->name('admin-site');
    Route::post('/site-setting/update', 'SettingController@update')->name('admin-site-update');

    //................................Category Controller.............................................//
    Route::name('categories.')->prefix('category')->group(function () {
        Route::get('/index', 'CategoryController@index')->name('list');
        Route::get('/create', 'CategoryController@create')->name('create');
        Route::post('/', 'CategoryController@store')->name('store');
        Route::get('/{id}/show', 'CategoryController@show')->name('show');
        Route::get('/{id}/edit', 'CategoryController@edit')->name('edit');
         Route::post('/{id}', 'CategoryController@update')->name('update');
        Route::get('/delete/{id}', 'CategoryController@destroy')->name('destroy');
        Route::post('/category/set_order', 'CategoryController@setOrder')->name('orderCategory');

    });

    //................................Brand Controller.............................................//
    Route::name('brands.')->prefix('brand')->group(function () {
        Route::get('/index', 'BrandController@index')->name('list');
        Route::get('/create', 'BrandController@create')->name('create');
        Route::post('/', 'BrandController@store')->name('store');
        Route::get('/{id}/edit', 'BrandController@edit')->name('edit');
        Route::post('/{id}', 'BrandController@update')->name('update');
        Route::get('/delete/{id}', 'BrandController@destroy')->name('destroy');
    });

    //................................Attribute Controller.............................................//
    Route::name('attributes.')->prefix('attribute')->group(function () {
        Route::get('/index', 'AttributeController@index')->name('list');
        Route::get('/create', 'AttributeController@create')->name('create');
        Route::post('/', 'AttributeController@store')->name('store');
        Route::get('/{id}/edit', 'AttributeController@edit')->name('edit');
        Route::post('/{id}', 'AttributeController@update')->name('update');
        Route::get('/delete/{id}', 'AttributeController@destroy')->name('destroy');
    });

    //................................Report Controller.............................................//
    Route::name('reports.')->prefix('report')->group(function () {
        Route::any('/inventory', 'ReportController@inventory')->name('inventory');
        Route::any('/sales', 'ReportController@sales')->name('sales');
    });

    //.................................Product Controller..................................................//
    Route::name('products.')->prefix('product')->group(function () {
        Route::get('/', 'ProductController@index')->name('list');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::post('/', 'ProductController@store')->name('store');
        Route::get('/{id}/edit', 'ProductController@edit')->name('edit');
        Route::post('/update', 'ProductController@update')->name('update');
        Route::get('/addOption', 'ProductController@addField')->name('field');
        Route::delete('/{id}', 'ProductController@destroy')->name('destroy');
        Route::post('/set-order', 'ProductController@setOrder')->name('setOrder');
        Route::get('/delete-image/{albumName}/{photoName}', 'ProductController@delete_image')
            ->name('package.delete_image');

    });

    //.................................Slider Controller............................................................//
    Route::get('/sliders-view', 'SliderController@index')->name('admin-slider');


    //.................................Page Controller.........................................................//
    Route::name('pages.')->prefix('page')->group(function () {
        Route::get('/', 'PageController@index')->name('list');
        Route::post('/create', 'PageController@create')->name('create');
        Route::get('/edit/{id}', 'PageController@edit')->name('edit');
        Route::put('/update/{id}', 'PageController@update')->name('update');
        Route::get('/delete/{id}', 'PageController@delete')->name('delete');
        Route::post('/set_order', 'PageController@set_order')->name('order_pages');
    });


    Route::name('orders.')->prefix('orders')->group(
        function ()
        {
            Route::get('/', 'OrderController@index')->name('list');
            Route::get('/{id}/show', 'OrderController@show')->name('show');
            Route::get('/delete/{id}', 'OrderController@delete');
            Route::get('/create','OrderController@create')->name('create');
            Route::post('/store','OrderController@store')->name('store');
            Route::post('/change-status/{id}', 'OrderController@changestatus')->name('changeStatus');
        }
    );


    Route::name('banners.')->prefix('banner')->group(
        function () {
            Route::get('/', 'BannerController@index')->name('list');
            Route::get('/create', 'BannerController@create')->name('create');
            Route::post('/store', 'BannerController@store')->name('store');
            Route::get('/edit/{id}', 'BannerController@edit')->name('edit');
            Route::put('/update/{id}', 'BannerController@update')->name('update');
            Route::get('/destroy/{id}', 'BannerController@destroy')->name('delete');

        }
    );


    Route::name('contacts.')->prefix('contacts')->group(
        function () {
            Route::get('/', 'ContactController@index')->name('list');
            Route::post('/contacts-delete/{id}', 'ContactController@delete')->name('delete');
        }
    );

    Route::name('coupons.')->prefix('coupons')->group(
        function()
        {
            Route::get('/','CouponController@index')->name('list');
            Route::get('/create','CouponController@create')->name('create');
            Route::post('/store','CouponController@store')->name('store');
            Route::get('/edit/{id}','CouponController@edit')->name('edit');
            Route::post('/update/{id}','CouponController@update')->name('update');
            Route::post('/delete/{id}','CouponController@delete')->name('delete');

        }
    );

    Route::name('og.')->prefix('og')->group(
        function()
        {
            Route::get('/create','AdminController@ogCreate')->name('create');
            Route::post('/store','AdminController@ogStore')->name('store');

        }
    );
});
