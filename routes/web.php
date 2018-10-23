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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','IndexController@index')->name('index');

Route::get('/register','RegisterController@register')->name('register');
Route::post('/doregister','RegisterController@doregister')->name('doregister');
Route::get('/sendmobilecode', 'RegisterController@sendmobilecode')->name('ajax-send-modbile-code');

Route::get('/login','LoginController@login')->name('login');
Route::post('/dologin','LoginController@dologin')->name('dologin');




