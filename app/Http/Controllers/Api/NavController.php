<?php

namespace App\Http\Controllers\Api;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavController extends Controller
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
        $list = Nav::where($map)->get();
        return response()->json($list);
    }

    public function create()
    {
        $map = [
            ['status', ">=", 0]
        ];
        $list = Nav::where($map)->get();
        return response()->json($list);
    }

    /*
     * 增加导航栏
     */
    public function add(Request $request)
    {
        $arr = [
            'name' => $request->name,
            'alias' => $request->alias,
            'url' => $request->url,
            'orders' => $request->orders,
            'pid' => $request->pid,
            'status' => $request->status,
        ];
        if($request->pid!=0){
            $arr['pid'] = $request->pid;
            $parent_path = Nav::where("id",$request->pid)->value("path");
            $arr['path'] = $parent_path.$arr['pid'].',';
        }
        $nav_id = Nav::insertGetId($arr);

        if($nav_id){
            $message = [
                'code' => 1,
                'message' => '导航添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '导航添加失败，请稍后重试'
            ];
        }

        return response()->json($message);
    }

    public function info(Request $request){
        $info = Nav::where("id",$request->id)->first();
        return response()->json($info);
    }

    public function edit(Request $request){
        $arr = [
            'name' => $request->name,
            'alias' => $request->alias,
            'url' => $request->url,
            'orders' => $request->orders,
            'pid' => $request->pid,
            'status' => $request->status,
        ];
        if($request->pid!=0){
            $arr['pid'] = $request->pid;
            $parent_path = Nav::where("id",$request->pid)->value("path");
            $arr['path'] = $parent_path.$arr['pid'].',';
        }
        if(Nav::where('id',$request->id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '导航信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => "导航信息修改失败，请稍后重试"
            ];
        }
        return response()->json($message);
    }

    public function delete(Request $request){
        $arr_id = explode(',',$request->id);
        foreach ($arr_id as $id){
            if(Nav::where('id',$id)->update(['status'=>-1])){
                $message = [
                    'code' => 1,
                    'message' => '导航信息删除成功'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => "导航信息删除失败，请稍后重试"
                ];
            }
        }

        return response()->json($message);
    }
}
