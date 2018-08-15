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

//Route::get('/', function () {
//    return view('home.index');
//});

Route::group(['prefix'=>'cheng'],function () {
    Auth::routes();
    //退出登录
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

//获取验证码操作部分
Route::group(['prefix'=>'cheng','namespace'=>'Admin'],function () {
    Route::post('sendMsg', 'YzmController@sendMsg')->name('sendMsg');
});

//后台

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'auth'],function (){

    Route::get('home', 'HomeController@index');

    //角色管理
    Route::resource('role','RoleController');
    //权限管理
    Route::resource('permission','PermissionController');
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
    //留言管理
    Route::resource('feedback','FeedbackController');
    Route::get('feedback/reply/{id}','FeedbackController@reply');
    Route::post('feedback/reply_store','FeedbackController@replyStore');
});

//前台



Route::group(['namespace'=>'Home'],function (){
    Route::resource('/', 'IndexController');
    Route::get('diary', 'IndexController@diary')->name('diary');
    //文章列表页
    Route::get('article_list/{category_id}', 'IndexController@articleList');
    //文章详情页
    Route::get('article_info/{article_id}','IndexController@articleInfo');
    Route::post('diary','IndexController@diary');
    //关于我
    Route::get('about_me','IndexController@aboutMe')->name('about_me');
    //关于博客
    Route::get('about_blog','IndexController@aboutBlog')->name('about_blog');
    //留言页面
    Route::get('feedback','FeedbackController@index')->name('feedback');
    //添加留言
    Route::post('addFeedback','FeedbackController@store')->name('addFeedback');
});

//文件管理模块路由开始
//-------------------------------------------------------------------------
Route::group(['prefix' => 'file', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::post('image_upload', 'FileController@imageUpload')->name('image.upload');
    Route::post('file_upload', 'FileController@fileUpload')->name('file.upload');
    Route::post('video_upload', 'FileController@videoUpload')->name('video.upload');
});