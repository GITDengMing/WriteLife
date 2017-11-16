@extends('layouts.layout_user',['user',$user])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/article_user_all.css')}}">
@endsection
@section('writes')
    <div class="row">
        <div class="col-md-6 ">
            <div class="art_list">
                <div class="text-center"><h3>童年趣事</h3></div>
                @foreach($data as $v)
                    @if($v->cat_id==1)
                <div class="art_list_tit">
                    <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}} </a><span class="write_time">{{$v->write_time}}</span>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="art_list">
            <div class="text-center"><h3>自传</h3></div>
            @foreach($data as $v)
                @if($v->cat_id==2)
            <div class="art_list_tit">
                <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}} </a><span class="write_time">{{$v->write_time}}</span>
            </div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="art_list">
            <div class="text-center"><h3>经历</h3></div>
            @foreach($data as $v)
                @if($v->cat_id==3)
            <div class="art_list_tit">
                <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}} </a><span class="write_time">{{$v->write_time}}</span>
            </div>
                @endif
            @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="art_list">
            <div class="text-center"><h3>经验教训</h3></div>
            @foreach($data as $v)
                @if($v->cat_id==4)
            <div class="art_list_tit">
                <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}} </a><span class="write_time">{{$v->write_time}}</span>
            </div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="art_list">
            <div class="text-center"><h3>生活小妙招</h3></div>
            @foreach($data as $v)
                @if($v->cat_id==5)
            <div class="art_list_tit">
                <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}} </a><span class="write_time">{{$v->write_time}}</span>
            </div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
@endsection
