@extends('layouts.home')

@section('content')
	<!-- 面包屑导航 开始 -->
	<div class="main breadcrumb_nav trans_3">
	<span class="layui-breadcrumb" lay-separator="—">
	  <a href="{{url('/')}}">首页</a><a href="">关于</a><a><cite>关于我</cite></a>
	</span>
	</div>
	<!-- 面包屑导航 结束 -->
	<div class="main">
		<div class="page_left">
		<div class="detail_container trans_3">
			<h1>关于我</h1>
			<div class="line"></div>
			<div class="content"><p>&nbsp; &nbsp; &nbsp; &nbsp; 大家好，欢迎来到老张博客！老张，其实并不老。张丹峰，95年生人，PHP程序员一枚，因为对PHP和Web前端有着相对比较浓厚的兴趣，所以现在从事着建站的工作。该博客是老张的第一个博客，也是老张自己开发的。这里将记录老张职业生涯的点点滴滴，感谢来访与关注！</p><p><br></p><p><b>老张博客</b></p><p>&nbsp; &nbsp; &nbsp; &nbsp; 在博客的首页可以看到三个词：“业精于勤”、”学无止境“、”工匠精神“。这三个词是老张的态度与精神，也是老张博客的灵魂。在该博客展现最多的也是学习与分享，记录学习的过程和方法，分享领域的问题和经验。</p></div>
		</div>
		</div>
		<div class="page_right">
			<div class="second_categorys_container">
				<h3>栏目导航</h3>
				<ol class="seond_category trans_3">
					<li class="selected" ><a href="{{route('about_me')}}" class="layui-btn layui-btn-primary trans_1">关于我</a></li>
					<li><a href="{{route('about_blog')}}" class="layui-btn layui-btn-primary trans_1">关于博客</a></li>
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