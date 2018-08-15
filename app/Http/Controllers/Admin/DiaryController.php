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
        if(no_permission('Diary')){
            return view(config('program.no_permission_to_view'));
        }
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
//        if(no_permission('createDiary')){
//            return view(config('program.no_permission_to_view'));
//        }
        $permission = get_user_permission();
        return view('admin.diary.add',compact("permission"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiaryRequest $request)
    {
        if(no_permission('createDiary')){
            return view(config('program.no_permission_to_view'));
        }
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
        if(no_permission('showDiary')){
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
        if(no_permission('editDiary')){
            return view(config('program.no_permission_to_view'));
        }
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
        if(no_permission('editDiary')){
            return view(config('program.no_permission_to_view'));
        }
        $arr = [
            'art'=>$request->editorValue,
            'status' => $request->status
        ];
        if(Diary::where("id",$id)->update($arr)){
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
        if(no_permission('destroyDiary')){
            return view(config('program.no_permission_to_view'));
        }
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
