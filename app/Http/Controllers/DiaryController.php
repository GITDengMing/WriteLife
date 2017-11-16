<?php

namespace App\Http\Controllers;

use App\Model\Diary;
use App\Model\User;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    public function index($uid)
    {
        $user = User::find($uid);
        $data = Diary::where('uid',$uid)->orderBy('dtime','desc')
            ->orderBy('id','desc')
            ->paginate(30);
        return view('diary_user_all')
                ->with('user',$user)
                ->with('data',$data);
    }

    public function detail($diary_id)
    {
        $diary = Diary::find($diary_id);
        $user = User::find($diary->uid);
        $data = ['diary'=>$diary,'user'=>$user];
        return view('diary_detail')
            ->with('data',$data);
    }
    public function create(Request $request)
    {
        $uid = session('logged_user')->id;
        $user = User::find($uid);
        if ($request->all()){
            $time = $request->time;
            $is_open = $request->is_open;
            $content = $request->my_content;
            //创建日记实例
            $diary = new Diary();
            $diary->uid = $uid;
            $diary->dtime = $time;
            $diary->dcontent = $content;
            $diary->jurisdiction = $is_open;
            if ($diary->saveOrFail()){
                return redirect('user/'.session('logged_user')->id);
            }else{
                return back()->with('create_err','服务器故障，添加日记失败');
            }
        }else{
            return view('diary_create')->with('user',$user);
        }
    }

    public function edit(Request $request,$diary_id)
    {
        $uid = session('logged_user')->id;
        $user = User::find($uid);
        $diary = Diary::find($diary_id);
        $data = ['diary'=>$diary,'user'=>$user];
        if ($request->all()){
            $time = $request->time;
            $is_open = $request->is_open;
            $content = $request->my_content;
            //修改后的日记
            $diary->uid = $uid;
            $diary->dtime = $time;
            $diary->dcontent = $content;
            $diary->jurisdiction = $is_open;
            if ($diary->saveOrFail()){
                return redirect('diary/'.$diary_id.'/detail');
            }else{
                return back()->with('create_err','服务器故障，添加日记失败');
            }
        }else{
            return view('diary_edit')->with('data',$data);
        }
    }

    public function delete($diary_id)
    {
        Diary::destroy($diary_id);
        return redirect('diary/'.session('logged_user')->id.'/index');
    }
}
