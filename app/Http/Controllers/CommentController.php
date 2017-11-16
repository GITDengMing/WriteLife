<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //发表评论
    public function publish(Request $request,$article_id)
    {
        if (session()->has('logged_user')){
            //以下为正常情况下
            $floor = Comment::where('artid',$article_id)->max('floor');
            $uid = session('logged_user')->id;
            $content = $request->commnet;
            $time =date('Y-m-d H:i:s',time());
            $commnet = new Comment();
            $commnet->uid =$uid;
            $commnet->artid = $article_id;
            $commnet->time = $time;
            $commnet->floor = ++$floor;
            $commnet->artcontent = $content;
            if ($commnet->saveOrFail()){
                return back();
            }else{

                return back();
            }
        }else{
            return back();
        }
    }
    //删除评论
    public function delete($comment_id)
    {
        Comment::destroy($comment_id);
        return back();
    }
}
