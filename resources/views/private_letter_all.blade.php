@extends('layouts.layout_user',['user'=>$user])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/private_letter_all.css')}}">
@endsection
@section('writes')
    <div class="all_letter">
        <div class="title text-center">
            所有私信
        </div>
        <hr>
        <div class="letter_list">
            @foreach($user->privateLetter->sortBy('state') as $v)
                <div class="letter">
                    <a href="{{url('private_letter/'.$v->id.'/detail')}}">{{$v->send_time}}</a>
                    @if($v->state == 1)
                        <span class="label label-success">已读</span>
                    @else
                        <span class="label label-warning">未读</span>
                    @endif
                    <span class="from_name">发信人：{{$v->send_user->nick_name}}</span>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection