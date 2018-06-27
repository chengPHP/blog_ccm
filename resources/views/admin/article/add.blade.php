@extends('layouts.admin')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>文章管理列表</h5>
                        <a href="{{ url('admin/article/create') }}" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn blue " id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                        {{--                        <a href="{{ url('admin/article/create') }}"  class="btn blue " id="add-btn"><i class="fa fa-plus"></i> 添加</a>--}}
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('admin/article')}}">
                            <div class="modal-body">
                                {{csrf_field()}}
                                <div class="form-group"><label class="col-sm-2 control-label">标题名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">文章类别</label>
                                    <div class="col-sm-10">
                                        <select class="form-control m-b" name="category_id">
                                            <option value="0">请选择</option>
                                            @foreach($category as $v)
                                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">文章简介</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="descr" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">文章内容</label>
                                    <div class="col-sm-10">
                                        <script id="editor" type="text/plain" style="width:100%;height:200px;"></script>
                                        <script type="text/javascript">
                                        //实例化编辑器
                                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                        var ue = UE.getEditor('editor');
                                        </script>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">关键词</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="tags" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">状态</label>
                                    <div class="col-sm-10">
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="inlineRadio1" value="1" name="status" checked="">
                                            <label for="inlineRadio1">启用 </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="inlineRadio2" value="0" name="status">
                                            <label for="inlineRadio2">禁用 </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="fanhui()" class="btn btn-default" >取消</button>
                                <button type="button" onclick="tijiao()" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" >
    function tijiao() {
        $.ajax({
            type: "post",
            url: "{{url('admin/article')}}",
            data: $('.form-horizontal').serialize(),
            dataType:"json",
            success: function (data) {
                if(data.code==1){
                    swal({
                        title: "",
                        text: data.message,
                        type: "success",
                        timer: 1000,
                    },function () {
                        window.location.href="{{url('admin/article')}}";
//                        window.location.reload();
                    });
                }else{
                    swal("", data.message, "error");
                }
            },
            error:function (jqXHR, textStatus, errorThrown) {
                blog.errorPrompt(jqXHR, textStatus, errorThrown);
            }
        });
    }

    function fanhui() {
        window.location.href="{{url('admin/article')}}";
    }

</script>
@endsection
