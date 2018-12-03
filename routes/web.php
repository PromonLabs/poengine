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

/* Route::get('/', function () {
    return view('pages/home');
}); */

Route::get('/', 'HomeController@index')->name('home');
Route::get('/process', 'ProcessController@index')->name('process');
Route::post('/order/list', 'OrderController@list')->name('order.list');
Route::post('/order/flow', 'OrderController@flow')->name('order.flow');
Route::get('/order', function () {
    return view('pages/order');
})->name('order');
