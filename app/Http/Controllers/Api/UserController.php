<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\RoleUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function dataList(Request $request)
    {
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
//        $list = User::where($map)->paginate(config("program.PAGE_SIZE"));
        $list = User::where($map)->get();
        return response()->json($list);
    }

    public function roleList(){
        $list = Role::where(['status'=>1])->get();
        return $list;
    }

    /*
     * 增加用户
     */
    public function add(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        if($user->save()){
            $user_info = User::where('email', $request->email)->first();
            if(count($request->role_id) > 0){
                foreach ($request->role_id as $k=>$v){
                    $arr = [
                        'user_id' => $user_info->id,
                        'role_id' => $v
                    ];
                    RoleUser::insert($arr);
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

    public function info(Request $request){
        $info = User::where("id",$request->id)->first();
        return response()->json($info);
    }

    public function edit(Request $request){
        $arr = [
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "status" => $request->status,
        ];
        if($request->password){
            $arr['password'] = bcrypt($request->password);
        }
        if(User::where('id',$request->id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '用户信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => "用户信息修改失败，请稍后重试"
            ];
        }
        return response()->json($message);
    }

    public function delete(Request $request){
        $arr_id = explode(',',$request->id);
        foreach ($arr_id as $id){
            if(User::where('id',$id)->update(['status'=>-1])){
                $message = [
                    'code' => 1,
                    'message' => '用户信息删除成功'
                ];
            }else{
                $message = [
                    'code' => 0,
                    'message' => "用户信息删除失败，请稍后重试"
                ];
            }
        }

        return response()->json($message);
    }
}
