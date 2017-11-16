<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\Follow;
use App\Model\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        $user = User::all();
        $user = $user->sortByDesc(function ($product,$key){
           return $product->fans->count();
        });
        $lyt = $user->take(10);
        //童年趣事
        $tnqs = Article::where('cat_id',1)->get();
        $tnqs = $tnqs->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $tnqs = $tnqs->take(10);
        //生活妙招
        $shmz =Article::where('cat_id',5)->get();
        $shmz =$shmz->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $shmz = $shmz->take(10);
        //经验教训
        $jyjx = Article::where('cat_id',4)->get();
        $jyjx = $jyjx->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $jyjx = $jyjx->take(10);
        //经历
        $jl = Article::where('cat_id',3)->get();
        $jl = $jl->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $jl= $jl->take(10);

        $zz = Article::where('cat_id',2)->get();
        $zz = $zz->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $zz= $zz->take(10);


        $articles = Article::orderBy('write_time','desc')->paginate(50);
        return view('index')
            ->with('articles',$articles)
            ->with('lyt',$lyt)
            ->with('tnqs',$tnqs)
            ->with('shmz',$shmz)
            ->with('jyjx',$jyjx)
            ->with('jl',$jl)
            ->with('zz',$zz);
    }

    public function tnqs()
    {
        $data = Article::where('cat_id',1)->orderBy('write_time','desc')->paginate(50);


        $rank = Article::where('cat_id',1)->get();
        $rank = $rank->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $rank= $rank->take(30);
        return view('index_article')->with('data',$data)->with('rank',$rank)->with('cat',1);
    }
    public function shmz()
    {

        $data = Article::where('cat_id',5)->orderBy('write_time','desc')->paginate(50);

        $rank = Article::where('cat_id',5)->get();
        $rank = $rank->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $rank= $rank->take(30);
        return view('index_article')->with('data',$data)->with('rank',$rank)->with('cat',5);
    }
    public function jyjx()
    {
        $data = Article::where('cat_id',4)->orderBy('write_time','desc')->paginate(50);
        $rank = Article::where('cat_id',4)->get();
        $rank = $rank->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $rank= $rank->take(30);
        return view('index_article')->with('data',$data)->with('rank',$rank)->with('cat',4);
    }
    public function jl()
    {
        $data = Article::where('cat_id',3)->orderBy('write_time','desc')->paginate(50);
        $rank = Article::where('cat_id',3)->get();
        $rank = $rank->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $rank= $rank->take(30);
        return view('index_article')->with('data',$data)->with('rank',$rank)->with('cat',3);
    }
    public function zz()
    {
        $data = Article::where('cat_id',2)->orderBy('write_time','desc')->paginate(50);
        $rank = Article::where('cat_id',2)->get();
        $rank = $rank->sortByDesc(function ($product,$key){
            return $product->comments->count();
        });
        $rank= $rank->take(30);
        return view('index_article')->with('data',$data)->with('rank',$rank)->with('cat',2);
    }
}
