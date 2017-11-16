<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($uid)
    {   //获取该用户的日记
//        $diary = Diary::where('uid',$uid)
//            ->orderBy('dtime','desc')
//            ->orderBy('id','desc')
//            ->offset(0)
//            ->limit(5)
//            ->get();
//        //获取该用户的重要日子
//        $impdate = ImportantDate::where('uid',$uid)
//            ->offset(0)
//            ->limit(5)
//            ->get();
//        //获取该用户的文章
//        $articles = Article::where('uid',$uid)
//            ->get();
//        //获取该用户的个人信息
        $user = User::find($uid);
        return view('user_all',['uid'=>$uid])
                ->with('user',$user);
    }

    public function edit(Request $request)
    {
        $user = User::find(session('logged_user')->id);
        if ($request->all()){
            $gender = $request->gender;
            $email = $request->email;
            $nickname = $request->nickname;
            $realname = $request->realname;
            $birthday = $request->birthday;
            $brief_introduction = $request->brief_introduction;
            if ($gender =='unselected'){
                $user->sex = '';
            }elseif($gender == 'male'){
                $user->sex = "男";
            }else{
                $user->sex = '女';
            }
            $user->email = $email;
            $user->nick_name = $nickname;
            $user->real_name =$realname;
            $user->birthday = $birthday;
            $user->brief_introduction = $brief_introduction;
            if ($user->saveOrFail()){
                session(['logged_user'=>$user]);//更新session里的用户
                return back();
            }else{
                return back();
            }
        }else{
            return view('user_edit')->with('user',$user);
        }
    }

    public function changeheadimg(Request $request)
    {
        $user = User::find(session('logged_user')->id);
        if ($request->all()){
            $qiniu = new QiniuUploadController();
            $result=$qiniu->postDoupload($request);
            if ($result['is_success'] == true){//图片上传成功
                $user->head_img =config('qiniu.domain').'/'. $result['key'];
                if ($user->saveOrFail()){
                    session(['logged_user'=>$user]);//更新session里的用户
                    return back();
                }else{
                    return back();
                }
            }else{
                return back();
            }
        }

        return view('user_changeheadimg')->with('user',$user);
    }

    public function modifyPassword(Request $request)
    {
        if ($request->all()){
            $newpassword = $request->new_password;
            $confimpw = $request->confirm_password;
            if ($newpassword == $confimpw) {
                $user = User::find(session('logged_user')->id);
                $user->password = $newpassword;
                if ($user->saveOrFail()){
                    return redirect('login');
                }else{
                    return back();
                }
            }else{
                return back();
            }
        }else{
            return view('user_modify_password');
        }
    }
}
