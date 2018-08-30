<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WorkRequest;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status?$request->status:0;

        if($request->search){
            $search = $request->search;
            $map = [
                ['status', '=', $status,],
                ['user_id', '=', Auth::id()],
                ['contents', 'like', '%'.$search.'%']
            ];
        }else{
            $map = [
                'status' => $status,
                'user_id' => Auth::id()
            ];
        }
        $work_list = Work::where($map)->get();

        return view('admin.work.index',compact('status','work_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.work.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request)
    {
        $work = new Work();
        $work->contents = $request->contents;
        $work->work_details = $request->editorValue;
        $work->plan_start_time = $request->plan_start_time;
        $work->plan_end_time = $request->plan_end_time;
        $work->user_id = Auth::id();
        $work->status = 0;

        if($work->save()){
            $message = [
                'code' => 1,
                'message' => '工作计划添加成功'
            ];
        }else{
            $message = [
                'code' => 1,
                'message' => '工作计划添加失败，请稍后重试'
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
        $work_info = Work::where("id",$id)->first();
//        return view('admin.work.show',compact('work_info','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Work::find($id);
        return view('admin.work.edit',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arr = [
            'contents' => $request->contents,
            'work_details' => $request->editorValue,
            'plan_start_time' => $request->plan_start_time,
            'plan_end_time' => $request->plan_end_time,
        ];
        if(Work::where('id',$id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '工作计划修改成功'
            ];
        }else{
            $message = [
                'code' => 1,
                'message' => '工作计划修改失败，请稍后重试'
            ];
        }
        return response()->json($message);
    }

    /*
     * 工作计划开始
     */
    public function start_work(Request $request){
        $arr = [
            'status' => 1,
            'start_time' => date('Y-m-d H:i:s')
        ];
        $info = Work::where('id',$request->id)->update($arr);
        if($info){
            $message = [
                'code' => 1,
                'message' => '工作计划开始成功'
            ];
        }else{
            $message = [
                'code' => 1,
                'message' => '工作计划开始失败，请稍后重试'
            ];
        }
        return response()->json($message);
    }


    public function do_complete_work($id){
        $info = Work::where("id",$id)->first();
        return view("admin.work.complete",compact("info",'id'));
    }

    /*
     * 工作计划完成
     */
    public function complete_work(Request $request){
        $arr = [
            'work_result' => $request->editorValue,
            'end_time' => $request->end_time,
            'status' => 2
        ];
        $info = Work::where('id',$request->id)->update($arr);
        if($info){
            $message = [
                'code' => 1,
                'message' => '工作完成提交成功'
            ];
        }else{
            $message = [
                'code' => 1,
                'message' => '工作完成提交失败，请稍后重试'
            ];
        }
        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 关闭工作计划
     */
    public function destroy($id)
    {
        //把ids字符串拆分成数组
        $idArr = explode(",",$id);
        foreach ($idArr as $v) {
            $info = Work::where('id', $v)->update(['status' => -1]);
            if($info){
                $message = [
                    'code' => 1,
                    'message' => '工作计划关闭成功'
                ];
            }
        }
            $message = [
                'code' => 1,
                'message' => '工作计划关闭失败，请稍后重试'
            ];
        return response()->json($message);
    }
}
