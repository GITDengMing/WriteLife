<?php

namespace App\Http\Controllers;

use App\Model\Album;
use App\Model\User;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    
    public function all($uid)
    {
        $user = User::find($uid);
        return view('album_all')->with('user',$user);
    }

    public function delete($album_id)
    {
        Album::destroy($album_id);
        return back();
    }

    public function edit(Request $request,$album_id)
    {
        $name = $request->album_name;
        $description =$request->album_description;
        $is_open = $request->is_open;

        $album = Album::find($album_id);
        $album->ab_name = $name;
        $album->abdescription = $description;
        $album->jurisdiction = $is_open;
        if ($album->saveOrFail()){
            return back();
        }else{
            return back();
        }
    }
    public function create(Request $request)
    {
        $uid = session('logged_user')->id;
        $name = $request->album_name;
        $description =$request->album_description;
        $is_open = $request->is_open;
        //创建相册实例
        $album = new Album();
        $album->uid = $uid;
        $album->ab_name = $name;
        $album->abdescription = $description;
        $album->jurisdiction = $is_open;
        if ($album->saveOrFail()){
            return back();
        }else{
            return back();
        }
    }
}
