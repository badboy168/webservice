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


    Route::get('test', 'AppController@test');


    //图片base64码生成图片，并保存到目录
    //关联文件 C:\wamp64\www\webservice\app\Modules\App\Http\Controllers\AppController.php
    //保存路径 C:\wamp64\www\webservice\app\public\image
    //生成地址 http://127.0.0.1/webservice/public/index.php/api/app/show_image
    //显示地址 http://127.0.0.1/webservice/public/image/show_image.jpg
    Route::get('show_image', 'AppController@show_image');


    //管理登录
    Route::post('admin/login', 'AdminController@login');

    //登录
    Route::post('login', 'AppController@login');

    //发送短信
    Route::post('sms', 'AppController@sms');


    //App
    Route::resource('/', 'AppController');

});

//Route::get('/app', function (Request $request) {
//    // return $request->app();
//})->middleware('auth:api');
