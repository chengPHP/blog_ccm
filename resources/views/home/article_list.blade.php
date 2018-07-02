@extends('layouts.home')

@section('content')
    <!-- 面包屑导航 开始 -->
    <div class="main breadcrumb_nav trans_3">
	<span class="layui-breadcrumb" lay-separator="—">
	  <a href="{{url('/')}}">首页</a><a href="">学无止境</a><a><cite>PHP</cite></a>
	</span>
    </div>
    <!-- 面包屑导航 结束 -->

    <!-- 文章 开始 -->
    <div class="main">
        <div class="page_left">
            <ul class="page_left_list">
                @if(count($list))
                    @foreach($list as $v)
                        <li class="no_pic">
                            <h2 class="title"><a href="{{url('article_info')}}/{{$v['id']}}">{{$v['title']}}</a></h2>
                            <div class="date_hits">
                                <span>{{$v['user']['name']}}</span>
                                <span>2个月前</span>
                                <span><a href="{{url('article_list')}}/{{$v['category_id']}}">{{$v['category']['name']}}</a></span>
                                <span class="hits"><i class="layui-icon" title="点击量"></i> {{$v['read_num']}} ℃</span>
                                <p class="commonts"><i class="layui-icon" title="点击量">&#xe63a;</i> <span id="" class="cy_cmt_count">{{$v['read_num']}}</span></p>
                            </div>
                            <div class="desc">
                                {{$v['descr']}}
                            </div>
                        </li>
                    @endforeach
                @else

                @endif
            </ul>
            {{$list->links()}}
        </div>
        <div class="page_right">
            <div class="second_categorys_container">
                <h3>栏目导航</h3>
                <ol class="seond_category trans_3">
                    @foreach($article_category as $v)
                        <li class="{{$v['id']==$list[0]['category_id']?'selected':''}}"><a href="{{url('article_list')}}/{{$v['id']}}" class="layui-btn layui-btn-primary trans_1">{{$v['name']}}</a></li>
                    @endforeach
                </ol>
            </div>
            <div class="recommend_list">
                <h3>推荐文章</h3>
                <ol class="page_right_list trans_3">
                    @foreach($article_new as $v)
                        <li><a href="{{url('article_info')}}/{{$v['id']}}">{{$v['title']}}</a><span class="hits"> {{$v['read_num']}} ℃ </span></li>
                    @endforeach
                </ol>
            </div>
            <div class="hot_list">
                <h3>最近热文</h3>
                <ol class="page_right_list trans_3">
                    @foreach($article_hot as $v)
                        <li><a href="{{url('article_info')}}/{{$v['id']}}">{{$v['title']}}</a><span class="hits"> {{$v['read_num']}} ℃ </span></li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- 文章 结束 -->
    
    
@endsection