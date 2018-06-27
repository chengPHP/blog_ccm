@extends('layouts.admin')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>文章管理列表</h5>
                        {{--<a href="{{ url('admin/article/create') }}" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn blue " id="add-btn"><i class="fa fa-plus"></i> 添加</a>--}}
                        <a href="{{ url('admin/article/create') }}"  class="btn blue " id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>状态</th>
                                    <th>标题名称</th>
                                    <th>关键词</th>
                                    {{--<th>文章简介</th>--}}
                                    <th>所属类别</th>
                                    <th>作者</th>
                                    {{--<th>文章内容</th>--}}
                                    <th>阅读量</th>
                                    <th>设置</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $v)
                                    <tr>
                                        <td>{{$v['id']}}</td>
                                        <td>
                                            @if($v['status']==0)
                                                关闭
                                            @else
                                                开启
                                            @endif
                                        </td>
                                        <td>{{$v['title']}}</td>
                                        <td>{{$v['tags']}}</td>
{{--                                        <td>{{$v['descr']}}</td>--}}
                                        <td>{{$v['category']['name']}}</td>
                                        <td>{{$v['user']['name']}}</td>
                                        {{--<td>--}}
                                            {{--@php--}}
                                                {{--echo htmlspecialchars_decode($v['art']);--}}
                                            {{--@endphp--}}
                                        {{--</td>--}}
                                        <td>{{$v['read_num']}}</td>
                                        <td>
                                            {{--<span title="修改信息" onclick="updateArticle('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-wrench" style="font-size: 24px;"></i> </span>--}}
                                            <a title="修改信息" href="{{url('admin/article')}}/{{$v['id']}}/edit" ><i class="fa fa-wrench" style="font-size: 24px;"></i> </a>
                                            <span title="删除文章" onclick="deleteArticle('{{$v['id']}}')"><i class="fa fa-trash-o" style="font-size: 24px;margin-left: 20px;"></i></span>
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
        function updateArticle(id) {
            $.ajax({
                url: "{{url('admin/article')}}/"+id+'/edit',
                type: 'GET',
                dataType: 'HTML',
                cache:false,
                beforeSend: function () {
                },
                success: function (data, textStatus, xhr) {
                    $(".bs-example-modal-lg .modal-content").html(data);
                }
            });
        }

        function deleteArticle(id) {
            swal({
                    title: "确定删除该类别吗？",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "取消",
                    confirmButtonText: "确认",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: "{{url('admin/article')}}"+'/'+id,
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