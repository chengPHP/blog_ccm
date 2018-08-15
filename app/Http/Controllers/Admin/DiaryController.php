<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DiaryRequest;
use App\Models\Diary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
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
                ["status",">=",0],
                ['art','like','%'.$search.'%']
            ];
        }else{
            $search = '';
            $map = [
                ["status",">=",0]
            ];
        }
        $list = Diary::where($map)->with('user')->paginate(config("program.PAGE_SIZE"));
        $permission = get_user_permission();
        return view('admin.diary.index',compact('list','search','permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.diary.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiaryRequest $request)
    {
        $diary = new Diary();
        $diary->user_id = auth()->id;
        $diary->status = $request->status;
        $diary->art = $request->editorValue;
        if($diary->save()){
            $message = [
                'code' => 1,
                'message' => '日记信息添加成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '日记信息添加失败，请稍后重试'
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
        $info = Diary::where("id",$id)->with('user')->first();
        return view('admin.diary.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiaryRequest $request, $id)
    {
        $arr = [
            'art'=>$request->editorValue,
            'status' => $request->status
        ];
        if(Diary::where("id",$id)->update()){
            $message = [
                'code' => 1,
                'message' => '日记信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '日记信息修改失败，请稍后重试'
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
            $info = Diary::where("id", $v)->update(['status' => -1]);
            if ($info) {
                continue;
            } else {
                $message = [
                    'code' => 0,
                    'message' => '日记信息删除失败，请稍后重试'
                ];
                return response()->json($message);
            }
        }
        $message = [
            'code' => 1,
            'message' => '日记信息删除成功'
        ];
        return response()->json($message);
    }
}
