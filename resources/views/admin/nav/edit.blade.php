<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">修改导航栏信息</h4>
</div>
<form method="post" class="form-horizontal" action="{{url('admin/nav')}}/{{$info->id}}">
    <div class="modal-body">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group"><label class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="{{$info->name}}" placeholder="导航栏名称" class="form-control">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">别名</label>
            <div class="col-sm-10">
                <input type="text" name="alias" value="{{$info->alias}}" placeholder="导航栏别名" class="form-control">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">超链接</label>
            <div class="col-sm-10">
                <input type="text" name="url" value="{{$info->url}}" placeholder="超链接" class="form-control">
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">排序</label>
            <div class="col-sm-10">
                <input type="text" name="orders" value="{{$info->orders}}" placeholder="排序" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="inlineRadio1" value="1" name="status" {{$info->status==1 ? 'checked': ''}}>
                    <label for="inlineRadio1">启用 </label>
                </div>
                <div class="radio radio-inline">
                    <input type="radio" id="inlineRadio2" value="0" name="status" {{$info->status==0 ? 'checked': ''}}>
                    <label for="inlineRadio2">禁用 </label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" onclick="tijiao()" class="btn btn-primary">提交</button>
    </div>
</form>

<script type="text/javascript" >
    function tijiao() {
        $.ajax({
            type: "post",
            url: "{{url('admin/nav')}}/{{$info->id}}",
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
                        window.location.reload();
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

</script>

