<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">添加推荐链接</h4>
</div>
<form method="post" class="form-horizontal" action="{{url('admin/link')}}">
    <div class="modal-body">
        {{csrf_field()}}
        <div class="form-group"><label class="col-sm-2 control-label">链接名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" value="" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-sm-2 control-label">链接标题</label>
            <div class="col-sm-10">
                <input type="text" name="title" value="" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-sm-2 control-label">链接url</label>
            <div class="col-sm-10">
                <input type="text" name="url" value="" class="form-control">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-sm-2 control-label">排序</label>
            <div class="col-sm-10">
                <input type="text" name="orders" value="" class="form-control">
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
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" onclick="tijiao()" class="btn btn-primary">提交</button>
    </div>
</form>

<script type="text/javascript" >
    function tijiao() {
        $.ajax({
            type: "post",
            url: "{{url('admin/link')}}",
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

