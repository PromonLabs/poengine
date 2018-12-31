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
    Route::get('/order/list', 'OrderController@orderList')->name('order.search.list');
    Route::post('/order/flow', 'OrderController@flow')->name('order.flow');
    Route::post('/order/update', 'OrderController@update')->name('order.update');
    Route::get('/process', 'ProcessController@index')->name('process');
    Route::post('/process/search/list', 'ProcessController@processSearchList')->name('process.search.list');
    Route::post('/process/list', 'ProcessController@list')->name('process.list');
    Route::post('/process/edit', 'ProcessController@edit')->name('process.edit');
    Route::post('/process/update', 'ProcessController@update')->name('process.update');
    Route::post('/order/search/list', 'OrderController@orderSearchList')->name('order.search.list');
});

Route::get('/test', function () {
    return view('welcome');
})->name('test');
