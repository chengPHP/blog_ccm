@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('nav'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{--<h5>导航栏管理列表</h5>--}}
                        @if(in_array(config('permissions.createArticle'),$permission))
                        <button onclick="add()" data-toggle="modal" data-target=".bs-example-modal-md" class="btn btn-m btn-primary" id="add-btn"><i class="fa fa-plus"></i> 添加</button>
                        @endif
                        @if(in_array(config('permissions.destroyArticle'),$permission))
                        <button onclick="delNavs()" class="btn btn-m btn-danger" id="add-btn"><i class="fa fa-trash-o"></i> 删除</button>
                        @endif
                        <div class="col-sm-5" style="float: right;" >
                            <div class="input-group">
                                <input type="text" id="search-text" placeholder="导航栏名称" value="{{$search}}" class="form-control">
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
                                    <th>导航栏名称</th>
                                    <th>导航栏别名</th>
                                    <th>超链接</th>
                                    <th>父级菜单</th>
                                    <th>排序</th>
                                    @if(in_array(config('permissions.Article'),$permission))
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
                                        <td>{{$v['alias']}}</td>
                                        <td><a href="{{url($v['url'])}}" target="_blank" >{{url($v['url'])}}</a></td>
                                        <td>{{$v['pid']}}</td>
                                        <td>{{$v['orders']}}</td>
                                        @if(in_array(config('permissions.Article'),$permission))
                                        <td>
                                            @if(in_array(config('permissions.editArticle'),$permission))
                                            <span class="btn btn-xs btn-info" title="修改信息" onclick="updateNav('{{$v['id']}}')" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-wrench"></i> 修改</span>
                                            @endif
                                            @if(in_array(config('permissions.destroyArticle'),$permission))
                                            <span class="btn btn-xs btn-danger" title="删除类别" onclick="deleteNav('{{$v['id']}}')"><i class="fa fa-trash-o"></i> 删除</span>
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
                url: "{{ url('admin/nav/create') }}",
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

        function updateNav(id) {
            $(".bs-example-modal-md .modal-content").html();
            $.ajax({
                url: "{{url('admin/nav')}}/"+id+'/edit',
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

        function deleteNav(id) {
            deleteItems(id,"{{url('admin/nav')}}","确定删除该导航菜单吗？");
        }

        function delNavs() {
            var checkStatus = $("tbody input[type='checkbox']:checked");
            if(checkStatus.length >= 1){
                var ids = [];
                $.each(checkStatus,function(i,v){
                    ids.push(v.value);
                });
                ids = ids.toString();
                deleteItems(ids,"{{url('admin/nav')}}","确定删除这些导航菜单吗？");

            }else{
                swal("请选择至少一条数据！", "", "warning");
            }
        }
        $("#simple-search").on('click',function () {
            window.location.href = "{{url('admin/nav')}}?search="+$("#search-text").val();
        });
    </script>

@endsection