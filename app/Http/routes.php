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
Route::group(['prefix'=>'newwebadmin','namespace'=>'Admin','middleware' => 'admin'],function(){
    Route::get('index','IndexController@index');//后台首页
    Route::get('admin_user_index','AdminUserController@index');//后台管理员列表
    Route::any('admin_user_edit/id/{id}','AdminUserController@edit');//后台管理员列表
    Route::any('set_effect','AjaxController@set_effect');//后台设置信息状态
    Route::any('admin_user_add','AdminUserController@add');//后台管理员添加
    Route::resource('user', 'UserController');//资源路由 用户管理
    Route::resource('category', 'CategoryController');//资源路由 文章分类管理
    Route::resource('article', 'ArticleController');//资源路由 文章管理
    Route::any('foreverdel','AjaxController@foreverdel');//后台永久删除信息
    Route::any('imageupload','IndexController@imageupload');//后台图片上传
    Route::any('delimage','IndexController@delimage');//后台永久删除图片
    Route::get('comment','CommentController@index');//后台留言列表
    Route::post('comment_delete','CommentController@delete');//后台留言删除
});

Route::get('newwebadmin/login',"Admin\\IndexController@login");//后台登录
Route::post('newwebadmin/dologin','Admin\\IndexController@dologin');//后台登录处理
Route::get('newwebadmin/logout',"Admin\\IndexController@logout");//后台退出登录

