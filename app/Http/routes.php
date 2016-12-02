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

//Route::get('/', function () {
//    return view('web/home/welcome');
//});
Route::get('/','Web\\HomeController@index');
Route::any('register','Web\\HomeController@register');
Route::any('login','Web\\HomeController@login');
Route::get('logout','Web\\HomeController@logout');
Route::get('lists/pid/{pid}','Web\\ArticleController@lists');//文章列表
Route::get('detail/id/{id}','Web\\ArticleController@detail');//文章详情
Route::get('about','Web\\HomeController@about');//关于我
Route::any('comment','Web\\HomeController@comment');//留言板

Route::controller("api","Web\\GlobalController");//获取图片验证码

//路由群组 -- 后台路由
Route::group(['prefix'=>'newwebadmin','namespace'=>'Admin'],function(){
    Route::get('login','IndexController@login');
    Route::get('index','IndexController@index');
});