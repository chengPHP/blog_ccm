@extends('layouts.admin')

@section('content')
    <script src="{{asset('admin/js/plugins/echart/echarts.js')}}" ></script>
    {{--<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('admin/home'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content text-center p-md">
                        <h2><span class="text-navy">博客后台</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}


    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">条</span>
                        <h5>文章数量</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$article_num}}</h1>
                        <div class="stat-percent font-bold text-info">今日 + {{$article_add_num}}条</div>
                        <small>总量</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">个</span>
                        <h5>类别信息</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$category_num}}</h1>
                        <div class="stat-percent font-bold text-info"> </div>
                        <small>总量</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">个</span>
                        <h5>日记信息</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$diary_num}}</h1>
                        <div class="stat-percent font-bold text-navy"> </div>
                        <small>总量</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-warning pull-right">人</span>
                        <h5>用户</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$user_num}}</h1>
                        <div class="stat-percent font-bold text-danger"> </div>
                        <small>总人数</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-lg-6" >
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>文章统计</h5>
                    </div>
                    <div class="ibox-content" style="padding-top: 30px;">
                        <div id="main1" style="height:300px"></div>
                    </div>

                    <script type="text/javascript">
                        var myChart1 = echarts.init(document.getElementById('main1'));
                        option = {
                            tooltip: {
                                trigger: 'item',
                                formatter: "{a} <br/>{b}: {c} ({d}%)"
                            },
                            legend: {
                                orient: 'horizontal',
                                left: 'center',
                                data:['PHP','Web前端','Linux','JavaScript','Vue']
                            },
                            series: [
                                {
                                    name:'工单状态',
                                    type:'pie',
                                    radius: ['0', '55%'],
                                    label: {
                                        normal: {
                                            formatter: '{a|{b}：}{c}',
                                            rich: {
                                            }
                                        }
                                    },
                                    data:[
                                        {value:"{{$article_arr[0]}}", name:'PHP'},
                                        {value:"{{$article_arr[1]}}", name:'Web前端'},
                                        {value:"{{$article_arr[2]}}", name:'Linux'},
                                        {value:"{{$article_arr[3]}}", name:'JavaScript'},
                                        {value:"{{$article_arr[4]}}", name:'Vue'}
                                    ]
                                }
                            ]
                        };
                        myChart1.setOption(option);
                    </script>
                </div>
            </div>

            <div class="col-lg-6" >
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>角色统计</h5>
                    </div>
                    <div class="ibox-content" style="padding-top: 30px;">
                        <div id="main2" style="height:300px"></div>
                    </div>

                    <script type="text/javascript">
                        var myChart2 = echarts.init(document.getElementById('main2'));
                        option = {
                            color: ['#3398DB'],
                            tooltip : {
                                trigger: 'axis',
                                axisPointer : {
                                    type : 'shadow'
                                }
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis : [
                                {
                                    type : 'category',
                                    data:[
                                        @foreach($role_list as $value)
                                            "{{$value['name']}}",
                                        @endforeach
                                    ],
                                    axisTick: {
                                        alignWithLabel: true
                                    }
                                }
                            ],
                            yAxis : [
                                {
                                    type : 'value'
                                }
                            ],
                            series : [
                                {
                                    name:'角色统计',
                                    type:'bar',
                                    barWidth: '40%',
                                    data:[
                                        @foreach($role_list as $v)
                                            {value:"{{$v['user_num']}}", name:"{{$v['name']}}"},
                                        @endforeach
                                    ]
                                }
                            ]
                        };
                        myChart2.setOption(option);
                    </script>

                </div>
            </div>

        </div>

    </div>



@endsection
