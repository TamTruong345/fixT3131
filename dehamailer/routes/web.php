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

Route::post('/import_customer', 'CustomerController@import');

Route::resource('customer', 'CustomerController');

Route::post('/setting/update', 'SettingController@update');

Route::resource('setting', 'SettingController');

Route::get('/send_mail', 'MailController@send_mail');

Route::post('/sender/update', 'SenderController@update');

Route::resource('sender', 'SenderController');


Route::post('/project/update', 'ProjectController@update');

Route::post('/project/search', 'ProjectController@search');

Route::get('/project/reset', 'ProjectController@reset');

Route::resource('project', 'ProjectController');