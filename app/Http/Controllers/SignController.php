<?php

namespace App\Http\Controllers;
require_once '/org/ucpaas/Ucpaas.class.php';
use App\Model\User;
use Illuminate\Http\Request;

class SignController extends Controller
{
    //登陆
    public function login(Request $request){
        if ($request->all()){
            $user_code = strtolower($request->captcha);//转成小写
            $phone = $request->phoneNum;
            $password = $request->password;
            if (session('milkcaptcha') == $user_code && $user_code != '') {
                //验证码正确

                $user= User::where([
                    ['state',1],
                    ['phone_number',$phone],
                    ['password',$password]
                ])->get();
                if ($user->isEmpty()){
                    return back()->with('err_pp','用户名或密码错误')->with('phone',$phone)->with('password',$password);
                }else{
                    session(['logged_user'=>$user[0]]);
                    return redirect("user/".$user->first()->id);
                }
            } else {
                //用户输入验证码错误
                return back()->with('err', '验证码错误！')->with('phone',$phone)->with('password',$password);
            }
        }else{
            return view('signin');
        }
    }
    //注册
    public function register(Request $request)
    {
        if ($request->all()){
            $sms = $request->sms;
            $phone = $request->reg_phone;
            if ($sms == session($phone.'sms')){//验证码正确
                $result =  User::where([
                    ['state',1],
                    ['phone_number',$phone]
                    ])->get();
                if ($result->isEmpty()){
                    $user = new User();
                    $user->nick_name = $request->reg_name;
                    $user->phone_number = $request->reg_phone;
                    $user->password=$request->reg_password;
                    $user->rig_time =date('Y-m-d H:i:s',time());
                    $user->save();
                    $user = User::find($user->id);
                    session(['logged_user'=>$user]);
                    return redirect('user/'.$user->id);
                }else{
                    $input = ['name'=>$request->reg_name,'phone'=>$request->reg_phone,'password'=>$request->reg_password];
                    return back()->with('Registered','手机号已注册')
                        ->with('name',$request->reg_name)
                        ->with('phone',$request->reg_phone)
                        ->with('password',$request->reg_password);
                }
            }else{
                return back()->with('sms_err','验证码错误')
                    ->with('name',$request->reg_name)
                    ->with('phone',$request->reg_phone)
                    ->with('password',$request->reg_password);
            }

        }else{
            return view('signup');
        }
    }
    //发送手机验证码
    public function sms($phoneNum)
    {

        $options['accountsid']='4461e47c5d8dd8f79350cb7527eaefbc';
        $options['token']='5afbefe8512f9f1b70e4482b0d774dfe';
        $ucpass = new \Ucpaas($options);
        $ucpass->getDevinfo('json');
        $appId = "07ec7e42182b4147a7c291eba33fc81f";
        $to = $phoneNum;
        $templateId = "58633";
        $a='';
        for ($i=0;$i<4;$i++){
            $a.=rand(0,9);
        }
        $param=$a;
        $result =$ucpass->templateSMS($appId,$to,$templateId,$param);
        $result = json_decode($result);
        if ($result->resp->respCode == '000000'){
            session([$phoneNum.'sms'=>$a]);
            return 'success';
        }else{
            return 'fail';
        }
    }
    //退出
    public function logout()
    {
        session()->forget('logged_user');
        return redirect('login');
    }
    //验证手机验证码
    public function verification(Request $request,$yzm)
    {
        if ($yzm == session($request->phone.'sms')){
            return 'true';
        }else{
            return 'false';
        }
    }
}
