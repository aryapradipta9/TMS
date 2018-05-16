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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/customer', 'CustomerController@index')->name('customer');

Route::get('/customer/add', 'CustomerController@create')->name('customer-form');

Route::post('/customer/add', 'CustomerController@store')->name('customer-add');

Route::get('/customer/delete', 'CustomerController@showDelete')->name('cust-showDelete');

Route::post('/customer/delete', 'CustomerController@destroy')->name('cust-delete');

Route::get('/vendor', 'VendorController@index')->name('vendor');

Route::get('/vendor/add', 'VendorController@create')->name('vendor-form');

Route::post('/vendor/add', 'VendorController@store')->name('vendor-add');

Route::get('/vendor/delete', 'VendorController@showDelete')->name('vendor-showDelete');

Route::post('/vendor/delete', 'VendorController@destroy')->name('vendor-delete');

Route::get('/moda', 'ModaController@index')->name('moda');

Route::get('/moda/add', 'ModaController@create')->name('moda-form');

Route::post('/moda/add', 'ModaController@store')->name('moda-add');

Route::get('/moda/delete', 'ModaController@showDelete')->name('moda-showDelete');

Route::post('/moda/delete', 'ModaController@destroy')->name('moda-delete');

Route::get('/distance', 'DistanceController@index')->name('dist');

Route::get('/distance/add', 'DistanceController@create')->name('dist-form');

Route::post('/distance/add', 'DistanceController@store')->name('dist-add');

Route::get('/distance/delete', 'DistanceController@showDelete')->name('dist-showDelete');

Route::post('/distance/delete', 'DistanceController@destroy')->name('dist-delete');

Route::get('/order', 'OrderController@index')->name('order');

Route::get('/order/add', 'OrderController@create')->name('order-form');

Route::post('/order/add', 'OrderController@store')->name('order-add');

Route::post('/order/select', 'OrderController@select')->name('order-select');

Route::get('/moda/select', 'ModaController@showModa')->name('moda-show');

Route::post('/moda/select', 'ModaController@select')->name('moda-select');

Route::get('/routing', 'RoutingController@index')->name('routing');

Route::get('/routing/delete', 'RoutingController@showDelete')->name('routing-showDelete');

Route::post('/routing/delete', 'RoutingController@destroy')->name('routing-delete');

Route::get('/routing/details/{id}', 'RoutingController@details')->name('routing-details');
