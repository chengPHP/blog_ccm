@extends('layouts.admin')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>推荐链接管理</h5>
                        <a href="{{ url('admin/link/create') }}" data-toggle="modal" data-target=".bs-example-modal-md" class="btn blue " id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>状态</th>
                                    <th>链接名称</th>
                                    <th>链接标题</th>
                                    <th>url</th>
                                    <th>排序</th>
                                    <th>设置</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $v)
                                    <tr>
                                        <td>{{$v['id']}}</td>
                                        <td>
                                            @if($v['status']==0)
                                                禁用
                                            @else
                                                启用
                                            @endif
                                        </td>
                                        <td>{{$v['name']}}</td>
                                        <td>{{$v['title']}}</td>
                                        <td><a href="{{$v['url']}}">{{$v['url']}}</a></td>
                                        <td>{{$v['orders']}}</td>
                                        <td>
                                            <span title="修改信息" onclick="updateLink('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-wrench" style="font-size: 24px;"></i> </span>
                                            <span title="删除类别" onclick="deleteLink('{{$v['id']}}')"><i class="fa fa-trash-o" style="font-size: 24px;margin-left: 20px;"></i></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
{{--                        {{$list->links()}}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" >
        function updateLink(id) {
            $.ajax({
                url: "{{url('admin/link')}}/"+id+'/edit',
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $(".bs-example-modal-md .modal-content").html(data);
                }
            });
        }

        function deleteLink(id) {
            swal({
                    title: "确定删除该推荐链接吗？",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "取消",
                    confirmButtonText: "确认",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: "{{url('admin/link')}}"+'/'+id,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": '{{csrf_token()}}',
                            '_method': 'delete'
                        },
                        beforeSend: function () {
                        },
                        success: function (data, textStatus, xhr) {
                            if(data.code==1){
                                swal({
                                    title: "",
                                    text: data.message,
                                    type: "success",
                                    timer: 1000,
                                },function () {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                });
        }

    </script>

@endsection