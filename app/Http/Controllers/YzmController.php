<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\DataCollector\SessionCollector;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Ucpaas;

class YzmController extends Controller
{
    public function sendMsg(Request $request){
        $appid = "2f28206e0d2b4f81b8e3c4068d9cdd6e";	//应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = "360273";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID

        //即将要发送的短信验证码为
        $yzm = get_rand_str(6);
//        $yzm = "asd123";
        session(['yzm' => $yzm]);
        //有效时间
        $active_time = '60';
        $param = $yzm.','.$active_time; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
        $mobile = $request->phone;
        $uid = "";

        //初始化必填
        //填写在开发者控制台首页上的Account Sid
        $options['accountsid']='09948686c588c5f85c7b73c69157bea8';
        //填写在开发者控制台首页上的Auth Token
        $options['token']='8a0de231715b6f3a021678149c353a6c';
        $ucpass = new Ucpaas($options);

        $result = $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);

        return response($result);
    }


}
