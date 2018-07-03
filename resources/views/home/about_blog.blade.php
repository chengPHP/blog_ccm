@extends('layouts.home')

@section('content')
	<!-- 面包屑导航 开始 -->
	<div class="main breadcrumb_nav trans_3">
	<span class="layui-breadcrumb" lay-separator="—">
	  <a href="{{url('/')}}">首页</a><a href="">关于</a><a><cite>关于博客</cite></a>
	</span>
	</div>
	<!-- 面包屑导航 结束 -->
	<div class="main">
		<div class="page_left">
		<div class="detail_container trans_3">
			<h1>关于LzCMS</h1>
			<div class="line"></div>
			<div class="content">
				<p>LzCMS(老张内容管理系统)，也就是老张博客的源码。LzCMS了老张博客用的同一个LOGO。
				LzCMS是用ThinkPHP+layui做的，简单方便，没有复杂的功能，就是一个简单博客系统。
				功能:
				1、内容模型有:单页模型、文章模型、链接模型、图集模型、下载模型。
				2、留言功能(可回复)
				3、文章评论(集成了搜狐的畅言评论，需后台配置即可)
				4、Sitemap有利于搜索引擎的收录

				<a href="http://www.phplaozhang.com/download-lists/13.html">立即下载</a>

				最开始只是想做一个个人网站个人博客而已，为了收集自己再工作中遇到的各种坑，也想把爬坑的方法分享给PHPer们，因为我遇到的绝大多数坑也都是在各位大神的分享中找到答案的。
				还有一个原因是作为一个PHPer怎么能没有自己的网站？给别人做那么多网站，为什么不给自己做一个呢？所以就给自己也捣鼓了一个。
				在我快做好的时候，我一个做UI的朋友也想做一个个人站，我就答应等我做好把源码给他，后来我想我为什么不把源码分享给所有人呢，如果有人看的起用了我的源码，也是对我的肯定。在此，我决定把源码分享。希望能给需要的人带来方便，大神们还望多多指教！！！ </p>
			</div>
		</div>
		</div>
		<div class="page_right">
			<div class="second_categorys_container">
				<h3>栏目导航</h3>
				<ol class="seond_category trans_3">
					<li><a href="{{route('about_me')}}" class="layui-btn layui-btn-primary trans_1">关于我</a></li>
					<li class="selected" ><a href="{{route('about_blog')}}" class="layui-btn layui-btn-primary trans_1">关于博客</a></li>
				</ol>
			</div>

			<div class="about_stationmaster_container">
				<h3>博主信息</h3>
				<ol class="page_right_list trans_3">
					<li>姓名：程传民</li><li>职业：PHP程序猿、WEB前端</li><li>座右铭：业精于勤、学无止境、工匠精神</li><li>QQ：1455394826 <a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=9e3d8ac1ba7022b4cc6a492c7645e0198a06afbde7e6d55cab5ca5dbbac5c186"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="老张博客-Lz-CMS交流群" title="老张博客-Lz-CMS交流群"></a></li>			</ol>
			</div>

		</div>
		<div class="clear"></div>
	</div>
@endsection