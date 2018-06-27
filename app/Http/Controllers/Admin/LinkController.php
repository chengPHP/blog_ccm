<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $map = [
            ['status',">=",0]
        ];
        $list = Link::where($map)->get();
        return view('admin.link.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.link.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {
        $link = new Link();
        $link->name = $request->name;
        $link->title = $request->title;
        $link->url = $request->url;
        $link->orders = $request->orders;
        $link->status = $request->status;
        if($link->save()){
            $message = [
                'code' => 1,
                'message' => '推荐网址添加成功'
            ];
        }else{
            $message = [
                'code' => 1,
                'message' => '推荐网址添加失败，请稍后重试'
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
        $info = Link::find($id);
        return view('admin.link.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, $id)
    {
        $arr = $request->except('_token','_method');
        if(Link::where("id",$id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '推荐链接信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '推荐链接信息修改失败，请稍后重试'
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
        if(Link::where('id',$id)->update(['status'=>-1])){
            $message = [
                'code' => 1,
                'message' => '推荐链接删除成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '推荐链接删除失败，请稍后重试'
            ];
        }
        return response()->json($message);
    }
}
