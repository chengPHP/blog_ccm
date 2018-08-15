@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('user'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        {{--<h5>用户管理列表</h5>--}}
                        @if(in_array(config('permissions.createUser'),$permission))
                            <button onclick="add()" class="btn btn-m btn-primary" id="add-btn" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-plus"></i> 添加</button>
                        @endif
                        @if(in_array(config('permissions.destroyUser'),$permission))
                            <button onclick="delUsers()" class="btn btn-m btn-danger" id="add-btn"><i class="fa fa-trash-o"></i> 删除</button>
                        @endif
                        <div class="col-sm-5" style="float: right;" >
                            <div class="input-group">
                                <input type="text" id="search-text" placeholder="邮箱" value="{{$search}}" class="form-control">
                                <span class="input-group-btn">
                                  <button type="button" class="btn blue" id="simple-search"><i class="fa fa-search"></i> 查询</button>
                                  <a href="javascript:;" class="btn btn-outline btn-default" id="refreshTable"><i class="fa fa-refresh"></i> 刷新</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="sltAll(this)" ></th>
                                    <th>id</th>
                                    <th>状态</th>
                                    <th>姓名</th>
                                    <th>手机号</th>
                                    <th>邮箱</th>
                                    @if(in_array(config('permissions.User'),$permission))
                                    <th>设置</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $v)
                                    <tr>
                                        <td><input type="checkbox" value="{{$v['id']}}"></td>
                                        <td>{{$v['id']}}</td>
                                        <td>
                                            @if($v['status']==0)
                                                禁用
                                            @else
                                                启用
                                            @endif
                                        </td>
                                        <td>{{$v['name']}}</td>
                                        <td>{{$v['phone']?$v['phone']:'暂无'}}</td>
                                        <td>{{$v['email']}}</td>
                                        @if(in_array(config('permissions.User'),$permission))
                                        <td>
                                            @if(in_array(config('permissions.editUser'),$permission))
                                                <span class="btn btn-xs btn-info" title="修改信息" onclick="updateUser('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-wrench"></i> 修改</span>
                                            @endif
                                            @if(in_array(config('permissions.destroyUser'),$permission))
                                                <span class="btn btn-xs btn-danger" title="删除用户" onclick="deleteUser('{{$v['id']}}')"><i class="fa fa-trash-o" ></i> 删除</span>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$list->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" >

        function add() {
            $(".bs-example-modal-md .modal-content").html();
            $.ajax({
                url: "{{ url('admin/user/create') }}",
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

        function updateUser(id) {
            $(".bs-example-modal-md .modal-content").html();
            $.ajax({
                url: "{{url('admin/user')}}/"+id+'/edit',
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
        //全选/全不选
        function sltAll(object) {
            if(object.checked){
                $("table tbody input[type=checkbox]").attr("checked",true);
            }else{
                $("table tbody input[type=checkbox]").attr("checked",false);
            }
        }

        function deleteItems(ids,url,title) {
            swal({
                    title: title,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "取消",
                    confirmButtonText: "确认",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: url+'/'+ids,
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
                                    timer: 1000
                                },function () {
                                    window.location.reload();
                                });
                            }else if (data.code==0){
                                swal({
                                    title: "",
                                    text: data.message,
                                    type: 'error',
                                    confirmButtonText: "确定"
                                },function () {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                });
        }


        function deleteUser(id) {
            deleteItems(id,"{{url('admin/user')}}","确定删除该用户吗？");
        }

        function delUsers() {
            var checkStatus = $("tbody input[type='checkbox']:checked");
            if(checkStatus.length >= 1){
                var ids = [];
                $.each(checkStatus,function(i,v){
                    ids.push(v.value);
                });
                ids = ids.toString();
                deleteItems(ids,"{{url('admin/user')}}","确定删除这些用户吗？");

            }else{
                swal("请选择至少一条数据！", "", "warning");
            }

        }

        $("#simple-search").on('click',function () {
            window.location.href = "{{url('admin/user')}}?search="+$("#search-text").val();
        });



    </script>

@endsection