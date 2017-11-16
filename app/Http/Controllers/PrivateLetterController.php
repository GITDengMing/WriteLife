<?php

namespace App\Http\Controllers;

use App\Model\PrivateLetter;
use App\Model\User;
use Illuminate\Http\Request;

class PrivateLetterController extends Controller
{
    //发送私信
    public function send(Request $request,$to_user_id)
    {
        $content = $request->pri_let_content;//私信内容
        $from = session('logged_user')->id;//发送人id
        //创建私信实例
        $letter = new PrivateLetter();
        $letter->from = $from;
        $letter->to = $to_user_id;
        $letter->pri_let_content = $content;
        $letter->send_time = date('Y-m-d H:i:s',time());
        if ($letter->saveOrFail()){
            return back();
        }else{
            return back();
        }
    }
    //私信内容
    public function detail($pri_let_id)
    {
        $letter = PrivateLetter::find($pri_let_id);
        $letter->state = 1;
        $letter->save();
        return view('private_letter_detail')->with('letter',$letter);
    }
    //所有私信
    public function all()
    {
        $uid =session('logged_user')->id;
        $user = User::find($uid);
//        $letters = $user->privateLetter;
//        $data = ['letters'=>$letters,'user'=>$user];
        return view('private_letter_all')->with('user',$user);
    }
    //删除私信
    public function delete($pri_let_id)
    {
        PrivateLetter::destroy($pri_let_id);
        return redirect('private_letter/all');
    }
}
