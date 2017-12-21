<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => "/app"], function () {


    //登录
    Route::post('/login', 'AppController@login');

    //发送短信
    Route::post('/sms', 'AppController@sms');

    //App
    Route::resource('/', 'AppController');

});

//Route::get('/app', function (Request $request) {
//    // return $request->app();
//})->middleware('auth:api');
