<?php

namespace App\Http\Controllers;

use App\Model\Follow;
use App\Model\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //用户关注的人
    public function followers($uid)
    {
        $user = User::find($uid);
        $followers = $user->followers;
        $data = ['follow'=>$followers,'user'=>$user];
        return view('follow_followers_list')
            ->with('data',$data)
            ->with('follower_cat','关注');
    }
    //用户的粉丝
    public function fans($uid)
    {
        $user = User::find($uid);
        $fans = $user->fans;
        $data = ['follow'=>$fans,'user'=>$user];
        return view('follow_followers_list')
            ->with('data',$data)
            ->with('follower_cat','粉丝');
    }
    //执行关注
    public function follow($follower_id)
    {
            $uid = session('logged_user')->id;
            $follow = new Follow();
            $follow->uid =$uid;
            $follow->followed_id=$follower_id;
            if ($follow->saveOrFail()){
                return back();
            }else{
                return back()->with('cancel','服务器异常，取关失败');
            }

    }
    //执行取关
    public function cancel($canceler_id)
    {
        $uid = session('logged_user')->id;
        $follow = Follow::where([
            ['uid',$uid],
            ['followed_id',$canceler_id]
        ])->first();
        if ($follow->delete()){
            return back();
        }else{
            return back()->with('cancel','服务器异常，取关失败');
        }

    }
}
