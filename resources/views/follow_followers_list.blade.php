@extends('layouts.layout_user',['user'=>$data['user']])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/follow_followers_list.css')}}">
@endsection
@section('writes')
    <div id="follow">
        <div class="illustrate">
            <p>{{$follower_cat}}列表</p>
            <hr>
        </div>
        <div class="follower_list">
            @foreach($data['follow'] as $v)
            <div class="follow_info">
                <a href="{{url('user/'.$v->id)}}"><img class="img-circle" src="{{$v->head_img}}" alt="">{{$v->nick_name}}</a><span style="padding: 15px;font-size: 13px;color: #888">{{$v->brief_introduction}}</span>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
@endsection