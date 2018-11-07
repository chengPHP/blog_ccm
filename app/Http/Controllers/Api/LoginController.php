<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $arr = [
            'name' => $request->name,
//            'password' => bcrypt($request->password)
        ];
        $user_info = User::where($arr)->first();
        if($user_info){
            if(!Hash::check($request->password, $user_info->password)){
                $message = [
                    'code' => 0,
                    'message' => '用户名或者密码错误，请重试'
                ];
            }else{
                $message = [
                    'code' => 1,
                    'message' => '登录成功',
                    'user_info' => $user_info
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