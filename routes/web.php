<?php

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

Route::get('/', 'LoginController@checklogin')->name('login');
Route::post('/login', 'LoginController@index')->name('login');

Route::middleware('loginSuccess')->group(function () {
    // route to process the form
    Route::post('/home', 'HomeController@index')->name('login');

    Route::get('home', 'HomeController@index')->name('home');
    Route::get('logout', 'HomeController@logout')->name('logout');
    Route::get('/process', 'ProcessController@index')->name('process');
    //Route::get('/order/', 'OrderController@index')->name('order');
    Route::post('/order/idlist', 'OrderController@idlist')->name('order.idlist');
    Route::get('/order/orderlist', 'OrderController@orderList')->name('order.orderlist');
    Route::post('/order/list', 'OrderController@list')->name('order.list');
    Route::post('/order/flow', 'OrderController@flow')->name('order.flow');
    Route::get('/order', function () {
        return view('pages/order');
    })->name('order');
});
