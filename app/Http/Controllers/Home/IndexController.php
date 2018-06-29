<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Diary;
use App\Models\Link;
use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $map = [
            'status' => '1'
        ];
        $article_list = Article::where($map)->with('user', 'category')->orderBy('created_at', 'desc')->paginate(10);
        //最新文章
        $article_new = Article::where($map)->orderBy('created_at', 'desc')->limit(10)->get();
        //最近热文
        $article_hot = Article::where($map)->orderBy('read_num', 'desc')->limit(10)->get();
        //友情链接
        $link_list = Link::where($map)->orderBy('orders', 'asc')->limit(5)->get();
        return view('home.index', compact('article_list', 'article_new', 'article_hot', 'link_list'));
    }

    //文章列表
    public function articleList($category_id)
    {
        $map = [
            ['status', '>=', 0],
            ['category_id', '=', $category_id]
        ];
        $list = Article::where($map)->orderBy('created_at', 'asc')->get();
        if (count($list) > 0) {
            return view('home.article_list', compact('list'));
        } else {
            return view('home.404');
        }
    }

    //文章详情
    public function articleInfo($id)
    {
        $map = [
            'status' => 1,
            'id' => $id
        ];
        $info = Article::where($map)->first();
        if ($info) {
            //上一篇
            $prev_article = Article::where([['id','<',$id],['status','=',1]])->orderBy('id','desc')->fitst();
            //下一篇
            $next_article = Article::where([['id','>',$id],['status','=',1]])->orderBy('id','asc')->first();
            Article::where('id', $id)->update(['read_num' => $info->read_num + 1]);
            return view('home.article_view', compact('info','prev_article','next_article'));
        } else {
            return view('home.404');
        }
    }

    //日记页面
    public function diary()
    {
        $map = [
            ['status', '>=', '0']
        ];
        $list = Diary::where($map)->orderBy('created_at', 'desc')->get();
        return view('home.diary', compact('list'));
    }


}