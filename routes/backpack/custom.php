<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('category', 'CategoryCrudController');
    // Route::post('category/save', 'CategoryCrudController@store')->name('category-save');

    Route::crud('unit', 'UnitCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('curency', 'CurencyCrudController');
    Route::crud('category_image', 'Category_imageCrudController');

    Route::get('users/test', 'UserCrudController@getUser')->name('users.index');
    Route::crud('product', 'ProductCrudController');
    Route::crud('order', 'OrderCrudController');
    Route::crud('payment', 'PaymentCrudController');
}); // this should be the absolute last line of this file