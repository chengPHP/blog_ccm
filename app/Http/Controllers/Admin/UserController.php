<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\RoleUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(no_permission('User')){
            return view(config('program.no_permission_to_view'));
        }
        if($request->search){
            $search = $request->search;
            $map = [
                ['status',">=",0],
                ['email',"like","%".$search."%"]
            ];
        }else{
            $search = '';
            $map = [
                ['status',">=",0]
            ];
        }
        $list = User::where($map)->paginate(config("program.PAGE_SIZE"));
        $permission = get_user_permission();
        return view("admin.user.index",compact('list','search','permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(no_permission('createUser')){
            return view(config('program.no_permission_to_view'));
        }
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(no_permission('createUser')){
            return view(config('program.no_permission_to_view'));
        }
        $arr = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => encrypt($request->password),
            'status' => $request->status,
        ];
        $user_id = User::insertGetId($arr);

        if($user_id){
            if(count($request->role_id) > 0){
                foreach ($request->role_id as $k=>$v){
                    $arr = [
                        'user_id' => $user_id,
                        'role_id' => $v
                    ];
                    RoleUser::create($arr);
                }
            }

            $message = [
                'code' => 1,
                'message' => '用户添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '用户添加失败，请稍后重试'
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
        if(no_permission('showUser')){
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
        if(no_permission('editUser')){
            return view(config('program.no_permission_to_view'));
        }
        $map = [
            'id' => $id
        ];
        $info = User::where($map)->with("roles")->where('status','>=',0)->first();
        if($info){
            return view('admin.user.edit',compact('info'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if(no_permission('editUser')){
            return view(config('program.no_permission_to_view'));
        }
        if($request->password){
            $arr = $request->except('_token','_method','role_id','repassword');
        }else{
            $arr = $request->except('_token','_method','role_id','password','repassword');
        }
        $info = User::where('id',$id)->update($arr);

        if(count($request->role_id)>0){
            //删除该用户之前所有的角色
            RoleUser::where("user_id",$id)->delete();
            //添加该用户角色
            foreach ($request->role_id as $k=>$v){
                RoleUser::insert(["role_id"=>$v,"user_id"=>$id]);
            }
        }

        if($info){
            $message = [
                'code' => 1,
                'message' => '用户信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '用户信息修改失败，请稍后重试'
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
        if(no_permission('destroyUser')){
            return view(config('program.no_permission_to_view'));
        }
        //把ids字符串拆分成数组
        $idArr = explode(",",$id);
        foreach ($idArr as $v) {
            if($v==1){
                $message = [
                    'code' => 0,
                    'message' => '超级管理员不能被删除'
                ];
                return response()->json($message);
            }else{
                if (User::where('id', $v)->update(['status' => -1])) {
                    continue;
                } else {
                    $message = [
                        'code' => 0,
                        'message' => '用户删除失败，请稍后重试'
                    ];
                    return response()->json($message);
                }
            }

        }
        $message = [
            'code' => 1,
            'message' => '用户删除成功'
        ];
        return response()->json($message);
    }
}
