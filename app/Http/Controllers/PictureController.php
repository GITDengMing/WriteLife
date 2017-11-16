<?php

namespace App\Http\Controllers;

use App\Model\Album;
use App\Model\Picture;
use App\Model\User;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function all($album_id)
    {
        $album = Album::find($album_id);
        $user = $album->user;

        $data = ['album'=>$album,'user'=>$user];
        return view('picture_all')->with('data',$data);
    }

    public function create(Request $request,$album_id)
    {
        $picture_des = $request->picture_des;
        $picture = new Picture();
        $picture->abid = $album_id;
        $picture->pdescription = $picture_des;
        $qiniu = new QiniuUploadController();
        $result=$qiniu->postDoupload($request);
        if ($result['is_success'] == true){//图片上传成功
            $picture->url =config('qiniu.domain').'/'. $result['key'];
            $picture->time= date('Y-m-d H:i:s',time());
            if ($picture->saveOrFail()){
                return back();
            }else{
                return back();
            }
        }else{
            return back();
        }
    }
    //删除照片
    public function delete($picture_id)
    {
        Picture::destroy($picture_id);
        return back();
    }
}
