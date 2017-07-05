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

Route::get('/', 'CustomerController@index');

Route::post('/template/update', 'TemplateController@update');

Route::resource('template', 'TemplateController');

Route::post('/customer/update', 'CustomerController@update');

Route::resource('customer', 'CustomerController');

Route::resource('setting', 'SettingController');
