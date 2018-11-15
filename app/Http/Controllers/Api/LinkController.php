<?php

namespace App\Http\Controllers\Api;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function dataList(Request $request)
    {
        if($request->search){
            $search = $request->search;
            $map = [
                ['status',">=",0],
                ['name',"like","%".$search."%"]
            ];
        }else{
            $search = '';
            $map = [
                ['status',">=",0]
            ];
        }
        $list = Link::where($map)->get();
        return response()->json($list);
    }

    /*
     * 增加推荐链接
     */
    public function add(Request $request)
    {
        if($request->user_id){
            vue_user_permission($request->user_id,'create.link');
        }else{
            return response()->json([
                'code' => 0,
                'message' => '抱歉，请先登录'
            ]);
        }
        $arr = [
            'name' => $request->name,
            'title' => $request->title,
            'url' => $request->url,
            'orders' => $request->orders,
            'status' => $request->status,
        ];
        $link_id = Link::insertGetId($arr);

        if($link_id){
            $message = [
                'code' => 1,
                'message' => '推荐链接添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '推荐链接添加失败，请稍后重试'
            ];
        }

        return response()->json($message);
    }

    public function info(Request $request){
        $info = Link::where("id",$request->id)->first();
        return response()->json($info);
    }

    public function edit(Request $request)
    {
        if($request->user_id){
            vue_user_permission($request->user_id,'edit.link');
        }else{
            return response()->json([
                'code' => 0,
                'message' => '抱歉，请先登录'
            ]);
        }
        $arr = [
            'name' => $request->name,
            'title' => $request->title,
            'url' => $request->url,
            'orders' => $request->orders,
            'status' => $request->status,
        ];
        if(Link::where('id',$request->id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '推荐链接信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => "推荐链接信息修改失败，请稍后重试"
            ];
        }
        return response()->json($message);
    }

    public function delete(Request $request)
    {
        if($request->user_id){
            vue_user_permission($request->user_id,'destroy.link');
        }else{
            return response()->json([
                'code' => 0,
                'message' => '抱歉，请先登录'
            ]);
        }
        $arr_id = explode(',',$request->id);
        foreach ($arr_id as $id){
            if(Link::where('id',$id)->update(['status'=>-1])){
                $message = [
                    'code' => 1,
                    'message' => '推荐链接信息删除成功'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => "推荐链接信息删除失败，请稍后重试"
                ];
            }
        }

        return response()->json($message);
    }
}
