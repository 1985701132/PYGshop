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
//前台注册
Route::get('/register','RegisterController@register')->name('register');
Route::post('/doregister','RegisterController@doregister')->name('doregister');
//手机短信验证码
Route::get('/sendmobilecode', 'RegisterController@sendmobilecode')->name('ajax-send-modbile-code');

//前台登陆
Route::get('/login','LoginController@login')->name('login');
Route::post('/login','LoginController@dologin')->name('dologin');

Route::get('/htindex','IndexController@htindex')->name('htindex');
Route::get('/home','IndexController@home')->name('home');

//管理员模块
Route::get('/admin','AdminController@admin')->name('administrator');
Route::post('/admin/insert','AdminController@insert')->name('admin.insert');
Route::post('/admin/edit','AdminController@edit')->name('admin.edit');
Route::get('/admin/delete','AdminController@delete')->name('admin.delete');

//后台登陆
Route::get('/htlogin','HtLoginController@login')->name('htlogin');
Route::post('/htlogin','HtLoginController@dologin')->name('htdologin');

//会员模块
Route::get('/user','UserController@user')->name('user_list');
Route::post('/user/insert','UserController@insert')->name('user.insert');
Route::post('/user/edit','UserController@edit')->name('user.edit');
Route::get('/user/delete','UserController@delete')->name('user.delete');
Route::get('/user/no','UserController@no')->name('user.no');
Route::get('/user/yes','UserController@yes')->name('user.yes');


