<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NavRequest;
use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $map = [
            ['status','>=','0'],
        ];
        $list = Nav::where($map)->orderBy("orders",'asc')->get();
        return view('admin.nav.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nav.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavRequest $request)
    {
        $nav = new Nav();
        $nav->name = $request->name;
        $nav->alias = $request->alias;
        $nav->url = $request->url;
        $nav->orders = $request->orders;
        $nav->status = $request->status;

        $info = $nav->save();
        if($info){
            $message = [
                'code' => 1,
                'message' => '导航栏添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '导航栏添加失败，请稍后重试'
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
        $info = Nav::find($id);
        return view('admin.nav.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NavRequest $request, $id)
    {
        $arr = [
            'name' => $request->name,
            'alias' => $request->alias,
            'url' => $request->url,
            'orders' => $request->orders,
            'status' => $request->status,
        ];
        if(Nav::where('id',$id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '导航栏信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '导航栏信息修改失败，请稍后重试'
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
        $info = Nav::find($id);
        if($info){
            if(Nav::where('id',$id)->update(['status' => -1])){
                $message = [
                    'code' => 1,
                    'message' => '导航栏删除成功'
                ];
            }else{
                $message = [
                    'code' => 1,
                    'message' => '导航栏删除失败，请稍后重试'
                ];
            }
        }else{
            $message = [
                'code' => 0,
                'message' => '请输入有效数据进行操作'
            ];
        }
        return response()->json($message);
    }
}
