@extends('layouts.home')

@section('content')
    <!-- 面包屑导航 开始 -->
    <div class="main breadcrumb_nav trans_3">
	<span class="layui-breadcrumb" lay-separator="—">
	  <a href="{{url('/')}}">首页</a><a><cite>日记</cite></a>
	</span>
    </div>
    <!-- 面包屑导航 结束 -->
    <div class="main ">
        <div class="axis_page">
            <div class="axis_container">
                <div class="y-line"></div>
                <h1><span><i class="layui-icon">&#xe642;</i></span>个人日记</h1>
                <ul>
                    @foreach($list as $v)
                        <li>
                            <div class="date">{{$v['created_at']}}</div>
                            <div class="icon"><i class="layui-icon">&#xe643;</i></div>
                            <div class="diary">
                                @php
                                    echo $v['art']
                                @endphp
                            </div>
                            <div class="clear"></div>
                        </li>
                    @endforeach
                    {{--<li>--}}
                        {{--<div class="date">2016年12月29日</div>--}}
                        {{--<div class="icon"><i class="layui-icon">&#xe643;</i></div>--}}
                        {{--<div class="diary">老张博客上线了！老张博客上线了！老张博客上线了！重要的事情要说三遍！</div>--}}
                        {{--<div class="clear"></div>--}}
                    {{--</li>--}}
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
@endsection