<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //dd(\Auth::user());
    return view('welcome');
});

Route::any('/wechat', 'WechatController@serve');

// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 授权登录
Route::get('auth/wechat', ['middleware' => 'wechat.oauth', 'uses' => 'Auth\AuthController@wechat']);
// 绑定微信解绑
Route::group(['middleware' => 'auth'], function () {
    Route::get('auth/wechat/bind', ['middleware' => 'wechat.oauth', 'uses' => 'Auth\AuthController@bindWechat']);
    Route::get('auth/wechat/unbind', 'Auth\AuthController@unbindWechat');
});

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// 密码重置链接请求路由...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// 密码重置路由...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('test', 'TestController@test');

Route::group(['middleware' => 'auth'], function() {

    Route::post('report/upload', 'ReportController@upload');
    Route::resource('report', 'ReportController');


    Route::resource('asset', 'AssetController');
    Route::resource('detail', 'DetailController');

});