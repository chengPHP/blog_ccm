@extends('layouts.home')

@section('content')
<!-- 面包屑导航 开始 -->
<div class="main breadcrumb_nav trans_3">
	<span class="layui-breadcrumb" lay-separator="—">
	  <a href="./index.html">首页</a><a><cite>留言</cite></a>
	</span>
</div>
<!-- 面包屑导航 结束 -->
<div class="main">
	<div class="page_left">
	<form class="layui-form feedback-form" method="post" action="{{route('addFeedback')}}">
		<div class="layui-form-item">
		    <div class="">
		    	<textarea name="content" lay-verify="layedit" autocomplete="off" placeholder="我要留言" class="llayui-textarea layui-hide" id="content"></textarea>
		    </div>
		</div>
		<div class="layui-form-item">
		    <button class="layui-btn" lay-submit="" lay-filter="feedback" type="button" >提交留言</button>
		</div>
	</form>
	<ul class="feedback_list">
		{{--@foreach($list as $k=>$v)
			<li>
				<div class="feedback_member">
					<div class="avatar"><i class="layui-icon">&#xe612;</i></div>
					<div class="name_date"><p class="name">游客留言</p>
					<p class="date">3天前</p></div>
					<div class="feedback_content">老张不赖呀</div>
				</div>
				@if($k['_child'])
					@foreach($k['_child'] as $k1=>$v1)
						<div class="feedback_member feedback_reply">
							<div class="avatar"><img src="{{asset('home/images/laozhang_avatar.png')}}" alt="老张头像"></div>
							<div class="name_date"><p class="name">老张</p>
								<p class="date">3天前</p></div>
							<div class="feedback_content reply_content">回复：老张不赖呀</div>
						</div>
					@endforeach
				@endif
			</li>
		@endforeach--}}

		<?php
        		$str = '';
        		$i = 0;
				function dg($list){
				    global $str;
				    global $i;
				    $i += 1;
				    foreach ($list as $k=>$v){
				        if(empty($v['user'])){
                            $v['user']['name'] = '游客';
						}
				        if($i>1){
                            $str .= '<div class="feedback_member feedback_reply">
									<div class="avatar"><i class="layui-icon">&#xe612;</i></div>
									<div class="name_date"><p class="name">'.$v['user']['name'].'</p>
									<p class="date">'.$v['created_at'].'</p></div>
									<div class="feedback_content">'.$v['content'].'</div>
								</div>';
						}else{
                            $str .= '<div class="feedback_member">
									<div class="avatar"><i class="layui-icon">&#xe612;</i></div>
									<div class="name_date"><p class="name">'.$v['user']['name'].'</p>
									<p class="date">'.$v['created_at'].'</p></div>
									<div class="feedback_content">'.$v['content'].'</div>
								</div>';
						}

				        if(!empty($v['_child'])){
				            dg($v['_child']);
						}
					}
					return $str;
				}

				$ss = dg($list);

				print_r($ss);

		?>


	</ul>
	</div>
	<div class="page_right">
		<div class="about_stationmaster_container">
			<h3>博主信息</h3>
			<ol class="page_right_list trans_3">
				<li>姓名：程传民</li>
				<li>职业：PHP程序猿、WEB前端</li>
				<li>座右铭：业精于请、学无止境、工匠精神</li>
				<li>QQ：1455394826 </li>
			</ol>
		</div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
layui.use(['form', 'layedit'], function(){
	var form = layui.form(),
  	layer = layui.layer,
  	layedit = layui.layedit,
  	$ = layui.jquery;

  //创建一个编辑器
  var content = layedit.build('content',{
  	tool: ['face', '|', 'left', 'center', 'right']
    ,height: 150
  });
  //表单验证
  form.verify({
    //编辑器数据同步
    layedit: function(value){
      layedit.sync(content);
      if(layedit.getText(content).length < 1){
        return '至少得 1 个字吧...';
      }
    }

  });
  //监听提交
  form.on('submit(feedback)', function(data){
  	var is_login = false;
  	$.post({
  		type:"POST",
        async:false,  //设置同步请求
        url:"{{route('addFeedback')}}",
        data: {
            'contents': data.field.content,
            "_token": '{{csrf_token()}}'
		},
        dataType:'json',
        success:function(data) {
            console.log(data);
            if(data.code==1){
			 layer.open({
				 title: '提示',
				 content: data.message,
				 yes: function () {
					 window.location.reload();
                 },
                 cancel: function(index, layero){
                     window.location.reload();
                 }
             });
            }else{
            }
        },
        error:function (jqXHR, textStatus, errorThrown) {
			alert("sss");
        }
  	});
    return false;
  });

});
</script>
</div>

@endsection