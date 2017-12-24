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

Route::get('/', 'StaticPagesController@home')->name('home');

//显示注册页面
Route::get('signup', 'UsersController@create')->name('signup');

//用户资源路由
Route::resource('users', 'UsersController');
//显示登陆页面
Route::get('signIn', 'SessionsController@create')->name('signIn');
//创建新会话（登陆）
Route::post('signIn', 'SessionsController@store')->name('signIn');
//销毁会话（退出登录）
Route::delete('signout', 'SessionsController@destroy')->name('signOut');
