<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function dataList(Request $request)
    {
        if($request->search){
            $search = $request->search;
            $map = [
                ['status',">=",0],
                ['title',"like","%".$search."%"]
            ];
        }else{
            $search = '';
            $map = [
                ['status',">=",0]
            ];
        }
        $list = Article::with('user','category','files')->where($map)->get();
        return response()->json($list);
    }

    public function create()
    {
        $list = Category::get();
        return response()->json($list);
    }

    /*
     * 新增
     */
    public function add(Request $request)
    {
        $category = new Article();
        $category->name = $request->name;
        $category->pid = $request->pid;
        if($request->pid==0){
            $category->path = '0,';
        }else{
            $path = Category::where("id",$request->pid)->value('path');
            $category->path = $path.','.$request->pid;
        }
        $category->status = $request->status;
        $info = $category->save();
        if($info){
            $message = [
                'code' => 1,
                'message' => '类别添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '类别添加失败'
            ];
        }
        return response()->json($message);
    }

    public function info(Request $request){
        $info = Article::where("id",$request->id)->first();
        return response()->json($info);
    }

    public function edit(Request $request){
        $arr = [
            "name" => $request->name,
            "pid" => $request->pid,
            "status" => $request->status,
        ];
        if(Article::where('id',$request->id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '类别信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => "类别信息修改失败，请稍后重试"
            ];
        }
        return response()->json($message);
    }

    public function delete(Request $request){
        //把ids字符串拆分成数组
        $idArr = explode(',',$request->id);
        $message = [];
        foreach ($idArr as $v){
            $info1 = Article::where('id',$v)->update(['status'=>-1]);
            if($info1){
                $message = [
                    'code' => 1,
                    'message' => '文章信息删除成功'
                ];
            }
        }

        return response()->json($message);
    }
}
