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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//});//->middleware('auth:api');


Route::group(['prefix' => getenv('API_PREFIX', 'v1')], function () {
    //用户API
    Route::resource('/user', 'UserController');
    //账户
    Route::resource('/account', 'AccountController');

});

//Route::resource('/user', 'UserController');
