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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Product
Route::prefix('product')->group(function () {
    Route::get('/', 'ProductController@index')->name('/');
    Route::get('detail', 'ProductController@show')->name('detail');
});

Route::prefix('shoppingcart')->group(function () {
    Route::get('/', function(){
        return view('carts.shoppingcart');
    })->name('/');

    Route::get('/checkout', function(){
        return view('carts.checkout');
    })->name('checkout');
});


