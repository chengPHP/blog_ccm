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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//后台
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'auth'],function (){
    //用户管理
    Route::resource('user','UserController');
    //类别管理
    Route::resource('category','CategoryController');
    //文章管理
    Route::resource('article','ArticleController');
    //导航栏
    Route::resource('nav','NavController');
    //个人日记
    Route::resource('diary','DiaryController');
    //推荐链接管理
    Route::resource('link','LinkController');
});