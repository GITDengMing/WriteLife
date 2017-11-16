<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class QiniuUploadController extends Controller
{
    //
    public function postDoupload(Request $request){
        $token=$this->getToken();//获取凭证
        $uploadManager=new UploadManager();
//        $name=session('logged_user')->phone_number.'/'.$_FILES['file']['name'];//文件名
        $name=session('logged_user')->phone_number.'/'.time().'.png';//文件名
        $filePath=$_FILES['file']['tmp_name'];//文件路径
        $type=$_FILES['file']['type'];//文件类型
        list($ret,$err)=$uploadManager->putFile($token,$name,$filePath,null,$type,false);
        if ($err){
            $info = ['is_success'=>false,'err'=>$err];
            return $info;
        }else{
            $info = ['is_success'=>true,'key'=>$ret['key']];
            return $info;
        }
//        if($err){//上传失败
//            var_dump($err);
//            return redirect()->back()->with('err',$err);//返回错误信息到上传页面
//        }else{//成功
//            //添加信息到数据库
//            return redirect()->back()->with('key',$ret['key']);//返回结果到上传页面
//        }
    }
    /**
     * 生成上传凭证
     * @return string
     */
    private function getToken(){
        $accessKey=config('qiniu.accessKey');
        $secretKey=config('qiniu.secretKey');
        $auth=new Auth($accessKey, $secretKey);
        $bucket=config('qiniu.bucket');//上传空间名称
        //设置put policy的其他参数
        //$opts=['callbackUrl'=>'http://www.callback.com/','callbackBody'=>'name=$(fname)&hash=$(etag)','returnUrl'=>"http://www.baidu.com"];
        return $auth->uploadToken($bucket);//生成token
    }
}
