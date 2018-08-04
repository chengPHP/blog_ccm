@extends('layouts.home')

@section('content')

    <style type="text/css">
        body{ font-family:"微软雅黑", Arial, sans-serif;} #main{border:none; background:none;}
        body,ul,li,h1,h2,h3,p,form{margin:0;padding:0;}body{background:#fbfbfb;color:#444;font-size:14px;}
        a{color:#444;text-decoration:none;}a:hover{color:red;}

        /* tagscloud */
        #tagscloud{width:250px;height:260px;position:relative;font-size:12px;color:#333;margin:20px auto 0;text-align:center;}
        #tagscloud a{position:absolute;top:0px;left:0px;color:#333;font-family:Arial;text-decoration:none;margin:0 10px 15px 0;line-height:18px;text-align:center;font-size:12px;padding:1px 5px;display:inline-block;border-radius:3px;}
        #tagscloud a.tagc1{background:#666;color:#fff;}
        #tagscloud a.tagc2{background:#F16E50;color:#fff;}
        #tagscloud a.tagc5{background:#006633;color:#fff;}
        #tagscloud a:hover{color:#fff;background:#0099ff;}
    </style>

    <!-- banner 开始 -->
    <div class="banner">
        {{--<div class="main index_main">--}}
        <div>
            <img class="banner_pic" src="{{asset('home/images/banner1.jpeg')}}" alt="banner_学无止境">
        </div>
    </div>
    <!-- banner 结束 -->
    <div class="main index_main">
        <ul class="index-learn">
            <li>
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>业精于勤</legend>
                    <p>“业精于勤荒于嬉”，精深的业技靠的是勤学、刻苦努力，靠的是争分夺秒的勤学苦练才会有精深的技术。得在认真，失在随便。</p>
                </fieldset>
            </li>
            <li>
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>学无止境</legend>
                    <p>学习，探索，研究，从不了解到了解，从无知到掌握，到灵活运用，在不断的学习中加深认识。由浅入深，由表及里。</p>
                </fieldset>
            </li>
            <li>
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>工匠精神</legend>
                    <p>精益求精，注重细节，追求完美和极致，不惜花费时间精力，孜孜不倦，反复改进产品，把99%提高到99.99%。</p>
                </fieldset>
            </li>
        </ul>
    </div>
    <div class="main index_main lzcms_banner">
        <a href="http://www.phplaozhang.com/download-lists/13.html" target="_blank"><img
                    src="{{asset('home/images/lzcms_banner.png')}}" alt="LzCMS下载"></a>
    </div>
    <!-- 文章 开始 -->
    <div class="main index_main">
        <div class="page_left">
            <ul class="page_left_list">
                @foreach($article_list as $v)
                    <li class="no_pic">
                        <h2 class="title"><a href="{{url('article_info')}}/{{$v['id']}}">{{$v['title']}}</a></h2>
                        <div class="date_hits">
                            <span>{{$v['user']['name']}}</span>
                            <span>{{$v['created_at']}}</span>
                            <span><a href="{{url('article_list')}}/{{$v['category_id']}}">{{$v['category']['name']}}</a></span>
                            <span class="hits"><i class="layui-icon" title="点击量"></i> {{$v['read_num']}} ℃</span>
                            <p class="commonts"><i class="layui-icon" title="点击量">&#xe63a;</i> <span id=""
                                                                                                     class="cy_cmt_count">{{$v['read_num']}}</span>
                            </p>
                        </div>
                        <div class="desc">
                            {{$v['descr']}}
                        </div>
                    </li>
                @endforeach
            </ul>
            {{$article_list->links()}}
        </div>
        <div class="page_right">
            <!--<div class="about_stationmaster_container">
                <h3>博主信息</h3>
                <ol class="page_right_list trans_3">
                    <li>姓名：张丹峰</li>
                    <li>职业：PHP程序猿、WEB前端</li>
                    <li>座右铭：业精于请、学无止境、工匠精神</li>
                    <li>QQ群：602099721</li>
                </ol>
            </div>-->
            <div class="new_list">
                <h3>最新文章</h3>
                <ol class="page_right_list trans_3">
                    @foreach($article_new as $v)
                        <li><a href="{{url('article_info')}}/{{$v['id']}}">{{$v['title']}}</a><span class="hits"> {{$v['read_num']}}
                                ℃ </span></li>
                    @endforeach
                    {{--<li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 135 ℃ </span></li>--}}
                </ol>
            </div>
            <div class="hot_list">
                <h3>最近热文</h3>
                <ol class="page_right_list trans_3">
                    @foreach($article_hot as $v)
                        <li><a href="{{url('article_info')}}/{{$v['id']}}">{{$v['title']}}</a><span class="hits"> {{$v['read_num']}}
                                ℃ </span></li>
                    @endforeach
                    {{--<li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 888 ℃ </span></li>--}}
                </ol>
            </div>
            <h3>友情连接</h3>
            <div class="links trans_3">
                @foreach($link_list as $v)
                    <a href="{{$v['url']}}" title="{{$v['title']}}" target="_blank">{{$v['name']}}</a>
                @endforeach
            </div>

            <h3>热门标签</h3>
            <div class="links trans_3">
                <div id="tagscloud">
                    <a href="http://www.jinliniuan.com/" class="tagc1">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">资源共享</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">2016</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">资源共享</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">2016</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">资源共享</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">2016</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">资源共享</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">2016</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">资源共享</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">2016</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc1">资源共享</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">互联网</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">金林苑</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">2016</a>
                    <a href="http://www.jinliniuan.com/" class="tagc5">编程之道</a>
                    <a href="http://www.jinliniuan.com/" class="tagc2">互联网</a>
                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
    <!-- 文章 结束 -->
    <script type="text/javascript" src="{{asset('admin/js/plugins/tagscloud/tagscloud.js')}}"></script>
@endsection