@extends('layouts.admin')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>个人日记管理</h5>
                        <a href="{{ url('admin/diary/create') }}"  class="btn blue " id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>状态</th>
                                    <th>日记内容</th>
                                    <th>时间</th>
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
                                        <td>
                                            @php
                                                echo $v['art'];
                                            @endphp
                                        </td>
                                        <td>{{$v['created_at']}}</td>
                                        <td>
                                            {{--<span title="修改信息" onclick="updateNav('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-wrench" style="font-size: 24px;"></i> </span>--}}
                                            <a title="修改信息" href="{{url('admin/diary')}}/{{$v['id']}}/edit" ><i class="fa fa-wrench" style="font-size: 24px;"></i> </a>
                                            <span title="删除类别" onclick="deleteDiary('{{$v['id']}}')"><i class="fa fa-trash-o" style="font-size: 24px;margin-left: 20px;"></i></span>
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
        function updateDiary(id) {
            $.ajax({
                url: "{{url('admin/diary')}}/"+id+'/edit',
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

        function deleteDiary(id) {
            swal({
                    title: "确定删除该期日记吗？",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "取消",
                    confirmButtonText: "确认",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: "{{url('admin/diary')}}"+'/'+id,
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