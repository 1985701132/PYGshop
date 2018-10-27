<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\RegistRequest;
use App\Models\User;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Hash;

class RegisterController extends Controller
{
    public function sendmobilecode(Request $req)
    {
        $mobile = $req->mobile;
        // 生成6位随机数
        $code = rand(100000,999999);
        
        //缓存时的名字
        $name = 'code-'.$req->mobile; 
        // 把随机数缓存起来（1分钟）
        Cache::put($name, $code, 1);

        // // 向消息队列中发消息
        // Redis::lpush('sms_list',$req->mobile.'-'.$code);

        // 发短信
        $config = [
            'accessKeyId'    => 'LTAIRFzYI935tz2L',
            'accessKeySecret' => 'iaNH3QUvwpqP2Fry0bECPmqPHvyNZW',
        ];
      
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($req->mobile);
        $sendSms->setSignName('彭文双sns项目');
        $sendSms->setTemplateCode('SMS_135043697');
        $sendSms->setTemplateParam(['code'=>$code]);

        print_r($client->execute($sendSms));

        // $req->session()->put('code',$code);


    }
    public function register(Request $req)
    {
        return view('register.register');
    }

    public function doregister(Request $req)
    {
        $password = Hash::make($req->password);
        $user = new User;
        // if($req->password !=$req->repassword)
        // {
        //     return back()->withInput()->withErrors(['repassword'=>'两次输入密码不一致']);

        // }

        // 拼出缓存的名字
        $name = 'code-'.$req->mobile;
        // 再根据名字取出验证码
        $code = Cache::get($name);
        // dd($code);
        if(!$code || $code != $req->mobile_code)
        {
            return back()->withErrors(['mobile_code'=>'验证码错误！']);
        }
      
        $user->username = $req->username;
        $user->mobile = $req->mobile;
        $user->password = $password;
        $user->save();
        return redirect()->route('login');

    }
}
