@extends('layouts.home')
@section('content')
<!-- 文章 开始 -->
<div class="main">
	<div class="page_left">	
	<div class="detail_container trans_3">
		<h1>{{$info['title']}}</h1>
		<div class="date_hits"><span><i>发布时间：</i>{{$info['created_at']}}</span><span><i>作者：</i>{{$info['user']['name']}}</span><span><i>热度：</i> {{$info['read_num']}} ℃</span><span><i>评论数：</i> <a href="#SOHUCS" id="changyan_count_unit">{{$info['read_num']}}</a></span></div>
		<div class="content">
			@php
				echo $info['art'];
			@endphp
		</div>
		<div class="keywords"><p>{{$info['tags']}}</p></div>
		<div class="prev_next">
			@if($prev_article)
				<div class="prev">上一篇：<a href="{{url('article_info')}}/{{$prev_article['id']}}">{{$prev_article['title']}}</a></div>
			@else
				<div class="prev">上一篇：暂无</div>
			@endif
			@if($next_article)
				<div class="next">下一篇：<a href="{{url('article_info')}}/{{$next_article['id']}}">{{$next_article['title']}}！</a></div>
			@else
					<div class="next">下一篇：暂无</div>
			@endif
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
			<ol class="seond_category trans_3">
				@foreach($article_category as $v)
					<li class="{{$v['id']==$info['category_id']?'selected':''}}"><a href="{{url('article_list')}}/{{$v['id']}}" class="layui-btn layui-btn-primary trans_1">{{$v['name']}}</a></li>
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