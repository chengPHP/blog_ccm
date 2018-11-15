<?php

namespace App\Http\Controllers\Api;

use App\Models\Permission;
use App\Models\Permission_role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $arr = [
            'name' => $request->name
        ];
        $user_info = User::where($arr)->with('roles')->first();
        if($user_info){
            if(!Hash::check($request->password, $user_info->password)){
                $message = [
                    'code' => 0,
                    'message' => '用户名或者密码错误，请重试'
                ];
            }else{
                $arrs = [];
                foreach ($user_info->roles as $role) {
                    $a = Permission_role::where('role_id',$role->id)->get();
                    foreach ($a as $v){
                        $arrs[] = $v->permission_id;
                    }
                }
                $permission_arr = [];
                $permission_id_arr = array_unique($arrs);
                foreach($permission_id_arr as $v){
                    $permission_arr[] = Permission::where('id',$v)->value('name');
                }
                $message = [
                    'code' => 1,
                    'message' => '登录成功',
                    'user_info' => $user_info,
                    'permission_arr' => $permission_arr
                ];
            }
        }else{
            $message = [
                'code' => 0,
                'message' => '用户名或者密码错误，请重试'
            ];
        }
        return response()->json($message);
    }
}
