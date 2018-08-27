<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Diary;
use App\Models\Role;
use App\Models\RoleUser;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $map = [
            ['status','>=',0]
        ];

        //文章总量
        $article_num = Article::where($map)->count();
        //今日文章新增量
        $article_add_num = Article::where($map)->whereDate('created_at', date("Y-m-d"))->count();

        //文章类别数量
        $category_num = Category::where($map)->count();

        //用户管理
        $user_num = User::where($map)->count();
        //日记数量
        $diary_num = Diary::where($map)->count();

        //文章统计
        //php
        $php_num = Article::where($map)->where(['category_id'=>1])->count();
        $web_num = Article::where($map)->where(['category_id'=>4])->count();
        $linux_num = Article::where($map)->where(['category_id'=>5])->count();
        $javascript_num = Article::where($map)->where(['category_id'=>6])->count();
        $vue_num = Article::where($map)->where(['category_id'=>9])->count();

        $article_arr = [$php_num,$web_num,$linux_num,$javascript_num,$vue_num];

        //角色统计
        $role_list = Role::where($map)->get()->toArray();

        //每个角色下面所包含用户量
        foreach ($role_list as $k=>$v){
            $user_nums = RoleUser::where('role_id',$v['id'])->count();
            $role_list[$k]['user_num'] = $user_nums;
        }

        return view('admin.index',
            compact('article_num','article_add_num','category_num',
                'user_num','diary_num','article_arr','role_list'
            )
        );
    }
}
