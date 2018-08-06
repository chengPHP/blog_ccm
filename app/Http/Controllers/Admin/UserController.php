<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
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
        return view("admin.user.index",compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->status = $request->status;
        $info = $user->save();
        if($info){
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
        $map = [
            'id' => $id
        ];
        $info = User::where($map)->where('status','>=',0)->first();
        if($info){
            return view('admin.user.edit',compact('info'));
        }else{

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
        if($request->password){
            $arr = $request->except('_token','_method','repassword');
        }else{
            $arr = $request->except('_token','_method','password','repassword');
        }
        $info = User::where('id',$id)->update($arr);
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
