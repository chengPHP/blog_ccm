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
                <li>
                    <a href="./article_view.html" class="pic"><img src="./images/article_pic.png" alt="老张博客上线了！"></a>
                    <h2 class="title"><a href="./article_view.html">老张博客上线了！</a></h2>
                    <div class="date_hits">
                        <span>老张</span>
                        <span>2个月前</span>
                        <span><a href="http://www.phplaozhang.com">老张博客</a></span>
                        <span class="hits"><i class="layui-icon" title="点击量"></i> 888 ℃</span>
                        <p class="commonts"><i class="layui-icon" title="点击量">&#xe63a;</i> <span id="" class="cy_cmt_count">888</span></p>
                    </div>
                    <div class="desc">今年(2016年)年初就打算做一个个人博客了，在年初时候想着才年初，今年还有很长时间，所以就没有着急，一直拖着，这一拖就是半年。在五六月分的时候，想着这都半年过去了，博</div>
                </li>
                <li class="no_pic">
                    <h2 class="title"><a href="./article_view.html">老张博客上线了！</a></h2>
                    <div class="date_hits">
                        <span>老张</span>
                        <span>2个月前</span>
                        <span><a href="http://www.phplaozhang.com">老张博客</a></span>
                        <span class="hits"><i class="layui-icon" title="点击量"></i> 888 ℃</span>
                        <p class="commonts"><i class="layui-icon" title="点击量">&#xe63a;</i> <span id="" class="cy_cmt_count">888</span></p>
                    </div>
                    <div class="desc">今年(2016年)年初就打算做一个个人博客了，在年初时候想着才年初，今年还有很长时间，所以就没有着急，一直拖着，这一拖就是半年。在五六月分的时候，想着这都半年过去了，博</div>
                </li>
                <li>
                    <a href="./article_view.html" class="pic"><img src="./images/article_pic.png" alt="老张博客上线了！"></a>
                    <h2 class="title"><a href="./article_view.html">老张博客上线了！</a></h2>
                    <div class="date_hits">
                        <span>老张</span>
                        <span>2个月前</span>
                        <span><a href="http://www.phplaozhang.com">老张博客</a></span>
                        <span class="hits"><i class="layui-icon" title="点击量"></i> 888 ℃</span>
                        <p class="commonts"><i class="layui-icon" title="点击量">&#xe63a;</i> <span id="" class="cy_cmt_count">888</span></p>
                    </div>
                    <div class="desc">今年(2016年)年初就打算做一个个人博客了，在年初时候想着才年初，今年还有很长时间，所以就没有着急，一直拖着，这一拖就是半年。在五六月分的时候，想着这都半年过去了，博</div>
                </li>
                <li class="no_pic">
                    <h2 class="title"><a href="./article_view.html">老张博客上线了！</a></h2>
                    <div class="date_hits">
                        <span>老张</span>
                        <span>2个月前</span>
                        <span><a href="http://www.phplaozhang.com">老张博客</a></span>
                        <span class="hits"><i class="layui-icon" title="点击量"></i> 888 ℃</span>
                        <p class="commonts"><i class="layui-icon" title="点击量">&#xe63a;</i> <span id="" class="cy_cmt_count">888</span></p>
                    </div>
                    <div class="desc">今年(2016年)年初就打算做一个个人博客了，在年初时候想着才年初，今年还有很长时间，所以就没有着急，一直拖着，这一拖就是半年。在五六月分的时候，想着这都半年过去了，博</div>
                </li>
                <li class="no_pic">
                    <h2 class="title"><a href="./article_view.html">老张博客上线了！</a></h2>
                    <div class="date_hits">
                        <span>老张</span>
                        <span>2个月前</span>
                        <span><a href="http://www.phplaozhang.com">老张博客</a></span>
                        <span class="hits"><i class="layui-icon" title="点击量"></i> 888 ℃</span>
                        <p class="commonts"><i class="layui-icon" title="点击量">&#xe63a;</i> <span id="" class="cy_cmt_count">888</span></p>
                    </div>
                    <div class="desc">今年(2016年)年初就打算做一个个人博客了，在年初时候想着才年初，今年还有很长时间，所以就没有着急，一直拖着，这一拖就是半年。在五六月分的时候，想着这都半年过去了，博</div>
                </li>
                <li class="no_pic">
                    <h2 class="title"><a href="./article_view.html">老张博客上线了！</a></h2>
                    <div class="date_hits">
                        <span>老张</span>
                        <span>2个月前</span>
                        <span><a href="http://www.phplaozhang.com">老张博客</a></span>
                        <span class="hits"><i class="layui-icon" title="点击量"></i> 888 ℃</span>
                        <p class="commonts"><i class="layui-icon" title="点击量">&#xe63a;</i> <span id="" class="cy_cmt_count">888</span></p>
                    </div>
                    <div class="desc">今年(2016年)年初就打算做一个个人博客了，在年初时候想着才年初，今年还有很长时间，所以就没有着急，一直拖着，这一拖就是半年。在五六月分的时候，想着这都半年过去了，博</div>
                </li>
            </ul>
            <div id="page">
                <ul class="pagination">
                    <li class="disabled"><span>&laquo;</span></li><li class="active"><span>1</span></li><li><a href="">2</a></li> <li><a href="">&raquo;</a></li>
                </ul>
            </div>
        </div>
        <div class="page_right">
            <div class="second_categorys_container">
                <h3>栏目导航</h3>
                <ol class="page_right_list trans_3">
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 888 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 5 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 320 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 135 ℃ </span></li>
                </ol>
            </div>
            <div class="recommend_list">
                <h3>推荐文章</h3>
                <ol class="page_right_list trans_3">
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 888 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 5 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 320 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 135 ℃ </span></li>
                </ol>
            </div>
            <div class="hot_list">
                <h3>最近热文</h3>
                <ol class="page_right_list trans_3">
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 888 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 5 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 320 ℃ </span></li>
                    <li><a href="http://www.phplaozhang.com">老张博客上线啦(二)</a><span class="hits"> 135 ℃ </span></li>
                </ol>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- 文章 结束 -->
    
    
@endsection