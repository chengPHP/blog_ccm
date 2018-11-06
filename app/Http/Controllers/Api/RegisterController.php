<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->status = 1;

        if($user->save()){
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
}
