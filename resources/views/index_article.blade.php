@extends('layouts.layout',['cat'=>$cat])
@section('css')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection
@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach( $data as $v)
                <div class="list">
                    <div class="recode" style="overflow: auto">
                        <div class="userInfo col-md-3">
                            <img src="{{$v->user->head_img}}" alt="" class="img-circle img-responsive" style="height: 60px;width: 60px;margin: 0 auto">
                            <div class="text-center writer_name" ><a href="{{url('user/'.$v->user->id)}}">{{$v->user->nick_name}}</a></div>
                        </div>
                        <div class="col-md-9" >
                            <div class="title"><a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}}</a></div>
                            <div style="max-height: 100px;overflow: hidden;color: #888">
                                {!! $v->acontent !!}
                            </div>
                            <div style="font-size: 10px;color: #aaa;padding-top: 30px">
                                <div style="float: left"><a href="#"><span class="glyphicon glyphicon-th-list" style="margin-right: 5px"></span>{{$v->category->cat_name}}</a></div>
                                <div style="float: right; margin-left:15px;">评论数：{{$v->comments->count()}}</div>
                                <div style="float: right">{{$v->write_time}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{$data->links()}}
            </div>
            <div class="col-md-4">
                <div class="ranking_list">
                    <div class="rank_name text-center">
                        本区评论最多
                    </div>
                    <hr>
                    <?php $i=0?>
                    @foreach($rank as $v)
                        <div class="rank_list">
                            {{++$i}}. <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}}</a><span style="margin-left: 5px;color: #aaa;font-size: 13px">评论数：{{$v->comments->count()}}</span>
                        </div>
                    @endforeach
                    <?php unset($i)?>
                </div>
            </div>
        </div>
    </div>
@endsection