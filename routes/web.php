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

Route::middleware(['auth'])->group(function () {
    Route::namespace('App')->group(function () {
        Route::prefix('app')->group(function () {
            Route::get('/list/data','ListController@get');
            Route::get('/edit','EditController@index');
            Route::post('/edit','EditController@edit');
            Route::post('/del','DeleteController@del');
        });
        Route::get('/app/list','ListController@index');
        Route::get('/app/create','CreateController@index');
        Route::post('/app/create','CreateController@create');
    });
});
//第三方登录
Route::namespace('Auth')->group(function () {
    Route::namespace('QQ')->group(function () {
        Route::prefix('qq')->group(function () {
            Route::get('login','QQLoginController@index')->name('qq_login');
            Route::get('login/callback','QQLoginCallbackController@index')->middleware(['sso.referer']);
        });

    });
});
Route::get('/sso/login','SSOController@login')->middleware(['sso.referer','auth']);

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
