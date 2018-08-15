<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(no_permission('Feedback')){
            return view(config('program.no_permission_to_view'));
        }
        if($request->search){
            $search = $request->search;
            $map = [
                ["status",">=",0],
                ['content','like','%'.$search.'%']
            ];
        }else{
            $search = '';
            $map = [
                ["status",">=",0]
            ];
        }
        $list = Feedback::where($map)->paginate(config("program.PAGE_SIZE"));

        $permission = get_user_permission();
        return view('admin.feedback.index',compact('list','search','permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(no_permission('createFeedback')){
            return view(config('program.no_permission_to_view'));
        }
        $permission = get_user_permission();
        return view('admin.feedback.add',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(no_permission('createFeedback')){
            return view(config('program.no_permission_to_view'));
        }
        $feedback = new Feedback();
        $feedback->content = $request->editorValue;
        $feedback->status = $request->status;
        if($request->pid){
            $feedback->pid = $request->pid;
        }else{
            $feedback->pid = 0;
        }
        if($feedback->save()){
            $message = [
                'code' => 1,
                'message' => '留言成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '留言失败，请稍后重试'
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
        if(no_permission('showFeedback')){
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
        if(no_permission('editFeedback')){
            return view(config('program.no_permission_to_view'));
        }
        $info = Feedback::find($id);
        return view('admin.feedback.edit',compact('info'));
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
        if(no_permission('editFeedback')){
            return view(config('program.no_permission_to_view'));
        }
        $arr = [
            'content' => $request->editorValue,
            'status' => $request->status
        ];
        if(Feedback::where('id',$id)->update($arr)){
            $message = [
                'code' => 1,
                'message' => '留言信息修改成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '留言信息修改失败，请稍后重试'
            ];
        }
        return response()->json($message);
    }


    public function reply($id)
    {
        if(no_permission('replyFeedback')){
            return view(config('program.no_permission_to_view'));
        }
        $info = Feedback::find($id);
        $permission = get_user_permission();
        return view('admin.feedback.reply',compact('info','permission'));
    }

    public function replyStore(Request $request)
    {
        if(no_permission('replyFeedback')){
            return view(config('program.no_permission_to_view'));
        }
        $feedback = new Feedback();
        $feedback->pid = $request->pid;
        $feedback->content = $request->editorValue;
        $feedback->status = $request->status;

        if($feedback->save()){
            $message = [
                'code' => 1,
                'message' => '留言回复成功'
            ];
        }else{
            $message = [
                'code' => 0,
                'message' => '留言回复失败，请稍后重试'
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
        if(no_permission('destroyFeedback')){
            return view(config('program.no_permission_to_view'));
        }
        //把ids字符串拆分成数组
        $idArr = explode(",",$id);
        foreach ($idArr as $v){
            if(Feedback::where('pid',$v)->first()){
                $message = [
                    'code' => 0,
                    'message' => '此留言下面还有回复留言，不能删除'
                ];
                return response()->json($message);
            }else {
                if (Feedback::where('id', $v)->update(["status"=>-1])) {
                    continue;
                }else{
                    $message = [
                        'code' => 0,
                        'message' => '此留言下面还有回复留言，不能删除'
                    ];
                    return response()->json($message);
                }
            }

        }
        $message = [
            'code' => 1,
            'message' => '留言信息删除成功'
        ];
        return response()->json($message);
    }
}
