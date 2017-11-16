<?php

namespace App\Http\Controllers;

use App\Model\ImportantDate;
use App\Model\User;
use Illuminate\Http\Request;

class ImportantDateController extends Controller
{
    //显示所有
    public function index()
    {
        $uid = session('logged_user')->id;
        $user = User::find($uid);
        $data = ImportantDate::where('uid',$uid)->get();
        return view('importantdate_all')
            ->with('data',$data)
            ->with('user',$user);
    }
    //添加
    public function create(Request $request)
    {
        $uid = session('logged_user')->id;
        $user = User::find($uid);
        if($request->all()){
            //获取所需数据
            $uid = session('logged_user')->id;
            $date = $request->date;
            $description = $request->description;
            $remarks =$request->remarks;
            //创建重要日子实例
            $impdate = new ImportantDate();
            $impdate->uid = $uid;
            $impdate->description = $description;
            $impdate->date = $date;
            $impdate->remark = $remarks;
            if ($impdate->saveOrFail()){
                return redirect('user/'.session('logged_user')->id);
            }else{
                return back()->with('create_err','服务器故障，添加日记失败');
            }
        }else{
            return view('importantdate_create')->with('user',$user);
        }

    }
    //修改
    public function edit(Request $request,$impdate_id)
    {
        $uid = session('logged_user')->id;
        $user = User::find($uid);
        $impdate = ImportantDate::find($impdate_id);
        $data = ['impdate'=>$impdate,'user'=>$user];
        if ($request->all()){
            //获取所需数据
            $date = $request->date;
            $description = $request->description;
            $remarks =$request->remarks;
            //修改后的重要日子
            $impdate->uid = $uid;
            $impdate->description = $description;
            $impdate->date = $date;
            $impdate->remark = $remarks;
            if ($impdate->saveOrFail()){
                return redirect('user/'.$uid);
            }else{
                return back()->with('create_err','服务器故障，修改重要日子失败');
            }
        }else{
            return view('importantdate_edit')->with('data',$data);
        }
    }

    public function delete($impdate_id)
    {
        ImportantDate::destroy($impdate_id);
        return back();
    }
}
