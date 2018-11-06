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

    //工作管理
    Route::resource('work','WorkController');
    Route::post('work/start_work','WorkController@start_work')->name('work.start_work');
    Route::get('work/do_complete_work/{id}','WorkController@do_complete_work');
    Route::post('work/complete_work','WorkController@complete_work');

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

//laravel+vue  api接口

Route::group(['prefix'=>'api','namespace'=>'Api'],function (){

    //登录
    Route::post('admin/login','LoginController@login');
    //注册
    Route::post('admin/register','RegisterController@register');
    //用户管理
    //获取用户列表
    Route::get('user/data_list','UserController@dataList');
    Route::get('user/role_list','UserController@roleList');
    //添加用户
    Route::post('user/add','UserController@add');
    //获取用户详情信息
    Route::post('user/info','UserController@info');
    //修改用户信息
    Route::post('user/edit','UserController@edit');
    //删除用户
    Route::post('user/delete','UserController@delete');

    //类别管理
    //获取类别列表
    Route::post('category/data_list','CategoryController@dataList');
    //添加类别
    Route::get('category/create','CategoryController@create');
    Route::post('category/add','CategoryController@add');
    //获取类别详情信息
    Route::post('category/info','CategoryController@info');
    //修改类别信息
    Route::post('category/edit','CategoryController@edit');
    //删除类别
    Route::post('category/delete','CategoryController@delete');

    //文章管理
    //获取文章列表
    Route::post('article/data_list','ArticleController@dataList');
    //添加文章
    Route::get('article/create','ArticleController@create');
    Route::post('article/add','ArticleController@add');
    //获取文章详情信息
    Route::post('article/info','ArticleController@info');
    //修改文章信息
    Route::post('article/edit','ArticleController@edit');
    //删除文章
    Route::post('article/delete','ArticleController@delete');

    //导航栏管理
    //获取导航栏列表
    Route::post('link/data_list','LinkController@dataList');
    //添加导航栏
    Route::post('link/add','LinkController@add');
    //获取导航栏详情信息
    Route::post('link/info','LinkController@info');
    //修改导航栏信息
    Route::post('link/edit','LinkController@edit');
    //删除导航栏
    Route::post('link/delete','LinkController@delete');

    //导航栏管理
    //获取导航栏列表
    Route::post('nav/data_list','NavController@dataList');
    //添加导航栏
    Route::get('nav/create','NavController@create');
    Route::post('nav/add','NavController@add');
    //获取导航栏详情信息
    Route::post('nav/info','NavController@info');
    //修改导航栏信息
    Route::post('nav/edit','NavController@edit');
    //删除导航栏
    Route::post('nav/delete','NavController@delete');

});