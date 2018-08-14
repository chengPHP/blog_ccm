<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
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
                ['status',">=",0],
                ['name',"like","%".$search."%"]
            ];
        }else{
            $search = '';
            $map = [
                ['status',">=",0]
            ];
        }
        $list = Permission::where($map)->paginate(config("program.PAGE_SIZE"));
        return view("admin.permission.index",compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.permission.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        if($request->display_name){
            $permission->display_name = $request->display_name;
        }
        if($request->description){
            $permission->description = $request->description;
        }
        $permission->pid = $request->pid;
        if($request->pid==0){
            $permission->path = "0,";
        }else{
            $permission->path = (Permission::where("id",$request->pid)->value("path")).$request->pid.',';
        }
        if($permission->save()){
            $message = [
                'code' => 1,
                'message' => '权限添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '权限添加失败，请稍后重试'
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
        $info = Permission::find($id);
        return view("admin.permission.edit",compact("info"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::find($id);

        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;

        if($request->pid==0){
            $permission->pid = 0;
            $permission->path = "0,";
        }elseif($request->pid!=$permission->pid){
            $permission->pid = $request->pid;
            $permission->path = (Permission::where("id",$request->pid)->value("path")).$request->pid.',';
        }

        if($permission->save()){
            $message = [
                'code' => 1,
                'message' => '权限信息更新成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '权限信息更新失败，请稍后重试'
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
        $list = Permission::where("pid",$id)->get()->toArray();
        if(count($list)>0){
            $message = [
                'code' => 0,
                'message' => '该权限下面还有子权限，不能删除'
            ];
        }else{
            if(Permission::where("id",$id)->update(['status'=>-1])){
                $message = [
                    'code' => 1,
                    'message' => '权限删除成功'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => '权限删除失败，请稍后重试'
                ];
            }
        }
        return response()->json($message);
    }
}
