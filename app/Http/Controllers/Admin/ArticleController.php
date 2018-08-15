<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search){
            $search = $request->search;
            $map = [
                ["status",">=",0],
                ['title','like','%'.$search.'%']
            ];
        }else{
            $search = '';
            $map = [
                ["status",">=",0]
            ];
        }
        $list = Article::with('user','category','files')->where($map)->paginate(config("program.PAGE_SIZE"));
        $permission = get_user_permission();
        return view('admin.article.index',compact('list','search','permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.article.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->descr = $request->descr;
        $article->tags = $request->tags;
        $article->art = $request->editorValue;
        $article->user_id = Auth::user()->id;
        $article->status = $request->status;
        $info = $article->save();

        $article->files()->sync($request->file);

        if($info){
            $message = [
                'code' => 1,
                'message' => '文章添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '文章添加失败，请稍后重试'
            ];
        }
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Article::with("user",'category')->find($id);
        $category = Category::all();
        return view("admin.article.edit",compact('info','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = new Article();
        $arr = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'descr' => $request->descr,
            'tags' => $request->tags,
            'status' => $request->status,
            'art' => $request->editorValue
        ];

        $info = Article::where("id",$id)->update($arr);
        if($info){
            $message = [
                'code' => 1,
                'message' => '文章信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '文章信息修改失败，请稍后重试'
            ];
        }
        return response()->json($message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //把ids字符串拆分成数组
        $idArr = explode(",",$id);
        foreach ($idArr as $v){
            $info1 = Article::where('id',$v)->update(['status'=>-1]);
            if($info1){
                continue;
            }else{
                $message = [
                    'code' => 0,
                    'message' => '文章信息删除失败，请稍后重试'
                ];
                return response()->json($message);
            }
        }
        $message = [
            'code' => 1,
            'message' => '文章信息删除成功'
        ];

        return response()->json($message);
    }
}
