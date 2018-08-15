<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Permission_role;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(no_permission('Role')){
            return view(config('program.no_permission_to_view'));
        }
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
        $list = Role::where($map)->paginate(config("program.PAGE_SIZE"));
        return view("admin.role.index",compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(no_permission('createRole')){
            return view(config('program.no_permission_to_view'));
        }
        //权限列表
        $permissions = Permission::get();
        return view("admin.role.add",compact("permissions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(no_permission('createRole')){
            return view(config('program.no_permission_to_view'));
        }
        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->status = $request->status;
        if($role->save()){
            $role_id = Role::where("name",$request->name)->value("id");
            if(count($request->permissions)>0){
                //中间表插入数据
                foreach ($request->permissions as $k=>$v){
                    $arr = [
                        'permission_id' => $v,
                        'role_id' => $role_id
                    ];
                    Permission_role::insert($arr);
                }
            }
            $message = [
                'code' => 1,
                'message' => '角色添加成功'
            ];

        }else{
            $message = [
                'code' => 1,
                'message' => '角色添加失败，请稍后重试'
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
        if(no_permission('showRole')){
            return view(config('program.no_permission_to_view'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(no_permission('editRole')){
            return view(config('program.no_permission_to_view'));
        }
        //权限列表
        $permissions = Permission::get();
        $info = Role::where("id",$id)->with("permission")->first();

        $arr = $info->permission->pluck('id')->all();

        foreach ($permissions as $k=>$v){
            if(in_array($v->id,$arr)){
                $permissions[$k]['checked'] = true;
            }
        }

        return view("admin.role.edit",compact('permissions','info'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(no_permission('editRole')){
            return view(config('program.no_permission_to_view'));
        }
        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->status = $request->status;
        if($role->save()){
            $role_id = $id;
            if(count($request->permissions)>0){
                //先删除之前的关联数据
                Permission_role::where("role_id",$role_id)->delete();
                //再添加关联表数据
                //中间表插入数据
                foreach ($request->permissions as $k=>$v){
                    $arr = [
                        'permission_id' => $v,
                        'role_id' => $role_id
                    ];
                    Permission_role::insert($arr);
                }
            }
            $message = [
                'code' => 1,
                'message' => '角色信息修改成功'
            ];

        }else{
            $message = [
                'code' => 1,
                'message' => '角色信息修改失败，请稍后重试'
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
        if(no_permission('Role')){
            return view(config('program.no_permission_to_view'));
        }
    }
}
