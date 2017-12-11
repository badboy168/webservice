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

//Route::get('/sms', function (Request $request) {
//    // return $request->sms();
//})->middleware('auth:api');

Route::group(['prefix' => getenv('API_PREFIX', 'v1')], function () {

    //发送短信
    Route::post('/sms/send', 'SmsController@send');
    //获取验证码
    Route::get('/sms/getCode', 'SmsController@getCode');
    //验证用户输入的验证码是否正确认
    Route::get('/sms/check/{mobile}/{smsCode}', 'SmsController@check');

//    Route::get('/sms/index', 'SmsController@index');
    //短信
//    Route::resource('/sms', 'SmsController');

});
