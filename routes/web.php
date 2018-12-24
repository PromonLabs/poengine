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
    Route::get('/api/{any}', 'SinglePageController@index')->where('any', '.*');
    // route to process the form
    Route::post('/home', 'HomeController@index')->name('login');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('logout', 'HomeController@logout')->name('logout');
    Route::post('/order/id/list', 'OrderController@orderIdList')->name('order.id.list');
    Route::get('/order/orderlist', 'OrderController@orderList')->name('order.orderlist');
    Route::post('/order/flow', 'OrderController@flow')->name('order.flow');
    Route::get('/process', 'ProcessController@index')->name('process');
    Route::post('/process/name/list', 'ProcessController@processNameList')->name('process.name.list');
    Route::post('/process/list', 'ProcessController@list')->name('process.list');
    Route::post('/process/edit', 'ProcessController@processEdit')->name('process.edit');

});

Route::get('/test', function () {
    return view('welcome');
})->name('test');
