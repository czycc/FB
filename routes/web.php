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
//服务端认证
Route::any('/wechat', 'WechatController@serve');

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/', function () {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料

        dd($user);
    });
});
Route::get('/img', 'ImgController@show');
