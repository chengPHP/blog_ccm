<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationCode;
use Illuminate\Http\Request;

use Ucpaas;

class YzmController extends Controller
{
    public function sendMsg(Request $request){
        $appid = "2f28206e0d2b4f81b8e3c4068d9cdd6e";	//应用的ID，可在开发者控制台内的短信产品下查看
        $templateid = "360273";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID

        //即将要发送的短信验证码为
        $yzm = get_rand_str(6);

        //有效时间
        $active_time = config("program.ACTIVE_TIME");

        //把验证码存放到数据库
        $VerificationCode = new VerificationCode();
        $VerificationCode->phone = $request->phone;
        $VerificationCode->yzm = $yzm;
        $VerificationCode->create_time_stamp = time();

        if(!$VerificationCode->save()){
            $result = [
                'code' => '-1',
                'message' => '获取验证码失败，请稍后重试'
            ];
            return response()->json($result);
        }

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
