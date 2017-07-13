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

Route::post('/customer/search', 'CustomerController@search');

Route::get('/customer/reset', 'CustomerController@reset');

Route::post('/create_mail', 'CustomerController@create_mail');

Route::resource('customer', 'CustomerController');

Route::resource('setting', 'SettingController');

Route::get('/send_mail', 'MailController@send_mail');