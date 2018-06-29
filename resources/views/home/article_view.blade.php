@extends('layouts.home')
@section('content')
<!-- 文章 开始 -->
<div class="main">
	<div class="page_left">	
	<div class="detail_container trans_3">
		<h1>老张博客上线了！</h1>
		<div class="date_hits"><span><i>发布时间：</i>2个月前</span><span><i>作者：</i>老张</span><span><i>热度：</i> 888 ℃</span><span><i>评论数：</i> <a href="#SOHUCS" id="changyan_count_unit">888</a></span></div>
		<div class="content">
			<p>
		       今年(2016年)年初就打算做一个个人博客了，在年初时候想着才年初，今年还有很长时间，所以就没有着急，一直拖着，这一拖就是半年。
		       在五六月分的时候，想着这都半年过去了，博客的事情该提上日程了。于是，我查了想要的域名，看了看服务器，发现阿里云的服务器还是挺贵的。然后说，先做程序(PHP程序猿一只，打算自己开发CMS)，想着做程序还是需要时间的，如果先买了服务器和域名的话，现在也用不上纯属浪费。奔着勤俭节约不浪费的传统美德，就没有买，但是程序也并没有开始做，只是偶尔会想一下怎么做。就这样，又过去了几个月。
		       直到九月份中下旬的时候，突然觉得，这再不开工就没时间了呀，因为白天要上班，只能晚上和周末时候有时间来做这个。终于在那一天，就是那一天，我上午选了域名www.pholaozhang.com，下午就买了当地一个IDC的虚拟主机(以后再升级嘛)，在那时候我的程序依然是一行也没有写。为什么之前没有写程序就不买域名和服务器而现在这么果断买了呢？是因为我觉得这件事该开工了，该提上日程了。买了域名和服务器就会觉得，如果再拖的话域名和服务器就浪费了。就这样，我的小项目就正式启动了。
		       买了域名服务器，域名备案，之后我几乎每天晚上加班两小时攻程(写程序)。到现在，终于告一段落了。
		       有时候，做一件事情最开始时候就不能拖延，开始拖延，后面就更拖延，到最后不能在计划的时间内完成。
		       总之，不管经历了什么，遇到了什么问题，现在，老张博客上线了。在开发过程中也遇到了之前没想到的各种小问题，不能说历经磨难，也算小有坎坷。至于开发过程用遇到的各种问题，在之后的文章里再做分享。之后本站的CMS也会做分享，希望各位大神多多指教！</p>
		</div>
		<div class="keywords"><p>老张博客，博客上线</p></div>
		<div class="prev_next">
			<div class="prev">上一篇：<a href="">老张博客上线了！</a></div>
			<div class="next">下一篇：<a href="">老张博客上线了！</a></div>
			<div class="clear"></div>
		</div>
		<div class="commont_containr">
			<!--【畅言】表情评价-->
			<div id="cyEmoji" role="cylabs" data-use="emoji" sid="{$data['category_id']}{$data['id']}"></div>
			<!--【畅言】PC和WAP自适应版-->
			<div id="SOHUCS" sid="{$data['category_id']}{$data['id']}" ></div> 
		</div>
			
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