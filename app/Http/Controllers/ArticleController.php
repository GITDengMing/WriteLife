<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\ArticleCat;
use App\Model\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($uid)
    {   $user = User::find($uid);
        $data = Article::where('uid',$uid)
            ->orderBy('write_time','desc')
            ->get();
        return  view('article_user_all')
            ->with('data',$data)
            ->with('user',$user);
    }

    public function create( Request $request, $cat_id)
    {
        $uid = session('logged_user')->id;
        $user = User::find($uid);
        if ($request->all()){
            $title = $request->title;
            $content = $request->my_content;
            $time = date('Y-m-d H:i:s',time());
            //创建模型实例
            $article = new Article();
            $article->uid = $uid;
            $article->cat_id =$cat_id;
            $article->acontent =$content;
            $article->title = $title;
            $article->write_time = $time;
            if ($article->saveOrFail()){
                return redirect('user/'.session('logged_user')->id);
            }else{
                return back()->with('create_err','服务器故障，添加失败');
            }
        }else{
            $catg=ArticleCat::find($cat_id);
            return view('article_create')
                ->with('user',$user)
                ->with('catg',$catg);
        }
    }
    //修改文章内容
    public function edit(Request $request,$article_id)
    {   $uid = session('logged_user')->id;
        $user = User::find($uid);

        $article = Article::find($article_id);
        $cat = ArticleCat::find($article->cat_id);
        $data = ['article'=>$article,'user'=>$user];
        if ($request->all()){
            $title = $request->title;
            $content = $request->my_content;
            //修改后的文章内容
            $article->uid = $uid;
            $article->cat_id =$article->cat_id;
            $article->acontent =$content;
            $article->title = $title;
            $article->modify_time = date('Y-m-d H:i:s',time());
            if ($article->saveOrFail()){
                return redirect('article/'.$article->id.'/detail');
            }else{
                return back()->with('create_err','服务器故障，修改日记失败');
            }
        }else{
            return view('article_edit')
                ->with('data',$data)
                ->with('cat_name',$cat->cat_name);
        }
    }
    //文章内容
    public function detail($art_id)
    {
        $article = Article::find($art_id);
//        $comments = $article->comments;
//        dd($comments->sortByDesc('floor'));
//        $cat = $article->category;
//        $cat = ArticleCat::find($article->cat_id);

        $writer = User::find($article->uid);//文章的作者
        $data =["article"=>$article,"writer"=>$writer];
        return view('article_details')
            ->with('data',$data);
    }

    public function delete($article_id)
    {
        Article::destroy($article_id);
        return redirect('user/'.session('logged_user')->id);
    }
}
