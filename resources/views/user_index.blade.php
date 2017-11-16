@extends('layouts.layout_user',['user'=>$data['user']])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/userindex.css')}}">
@endsection
@section('writes')
    @if(session()->has('logged_user') && $uid ==session('logged_user')->id)
        <div class="write">
            <div class="write_cat">
                <div class="text-center">
                    <p>重要日子</p>
                    <a type="button" href="{{url('imp_date/create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus">&nbsp;</span>添加</a>
                </div>
                <hr>
                @foreach($data['impdate'] as $v)
                    <div class="write_simple">
                        <div class="impdate_item"><span class="">日期：</span>{{$v->date}}</div>
                        <div class="impdate_item"><span class="">描述：</span>{{$v->description}}</div>
                        <div class="impdate_item"><span class="">备注：</span>{{$v->remark}}</div>
                    </div>
                    <hr>
                @endforeach
                <div>
                    <a type="button" href="{{url("imp_date/index")}}" class="btn btn-info center-block">更多&nbsp;<span class="glyphicon glyphicon-option-horizontal"></span></a>
                </div>
            </div>
        </div>
        <div class="write">
            <div class="write_cat">
                <div class="text-center">
                    <p>私信</p>
                </div>
                <hr>
                <div class="letters">
                    @foreach($data['user']->privateLetter->sortBy('state') as $v)
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
                    <a type="button" href="{{url("private_letter/all")}}" class="btn btn-info center-block">更多</a>
                </div>
            </div>
        </div>
        <div class="write">
            <div class="write_cat">
                <div class="text-center">
                    <p>日记</p>
                    <a type="button" href="{{url('diary/create')}}" class="btn btn-primary">添加</a>
                </div>
                <hr>
                <div class="dtime write_simple">
                    @foreach($data['diary'] as $v)
                        <a href="{{url('diary/'.$v->id.'/detail')}}">{{$v->dtime}}</a>
                        <hr>
                    @endforeach
                    <a type="button" href="{{url("diary/$uid/index")}}" class="btn btn-info center-block">更多</a>
                </div>

            </div>
        </div>
    @endif
    <div class="write">
        <div class="write_cat">
            <div class="text-center">
                <p>童年趣事</p>
                @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
                <a type="button" href="{{url('article/1/create')}}" class="btn btn-primary">添加</a>
                @endif
            </div>
            <hr>
            <div class="write_simple">
                @foreach($data['article'] as $v)
                    @if($v->cat_id == 1)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    <div>
                        <a type="button" href="{{url("article/$uid/all")}}" class="btn btn-info center-block">更多</a>
                    </div>
            </div>
        </div>
    </div>
    <div class="write">
        <div class="write_cat">
            <div class="text-center">
                <p>经历</p>
                @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
                <a type="button" href="{{url('article/3/create')}}" class="btn btn-primary">添加</a>
                @endif
            </div>
            <hr>
            <div class="write_simple">
                @foreach($data['article'] as $v)
                    @if($v->cat_id == 3)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    <div>
                        <a type="button" href="{{url("article/$uid/all")}}" class="btn btn-info center-block">更多</a>
                    </div>
            </div>
        </div>
    </div>
    <div class="write">
        <div class="write_cat">
            <div class="text-center">
                <p>经验教训</p>
                @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
                <a type="button" href="{{url('article/4/create')}}" class="btn btn-primary">添加</a>
                @endif
            </div>
            <hr>
            <div class="write_simple">
                @foreach($data['article'] as $v)
                    @if($v->cat_id == 4)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    <div>
                        <a type="button" href="{{url("article/$uid/all")}}" class="btn btn-info center-block"></span>更多</a>
                    </div>
            </div>
        </div>
    </div>
    <div class="write">
        <div class="write_cat">
            <div class="text-center">
                <p>自传</p>
                @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
                <a type="button" href="{{url('article/2/create')}}" class="btn btn-primary">添加</a>
                @endif
            </div>
            <hr>
            <div class="write_simple">
                @foreach($data['article'] as $v)
                    @if($v->cat_id == 2)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    <div>
                        <a type="button" href="{{url("article/$uid/all")}}" class="btn btn-info center-block">更多</a>
                    </div>
            </div>
        </div>
    </div>
    <div class="write">
        <div class="write_cat">
            <div class="text-center">
                <p>生活妙招</p>
                @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
                <a type="button" href="{{url("article/5/create")}}" class="btn btn-primary">添加</a>
                @endif
            </div>
            <hr>
            <div class="write_simple">
                @foreach($data['article'] as $v)
                    @if($v->cat_id == 5)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    <div>
                        <a type="button" href="{{url("article/$uid/all")}}" class="btn btn-info center-block">更多</a>
                    </div>
            </div>
        </div>
    </div>
    <div class="write">
        <div class="write_cat">
            <div class="text-center">
                <p>讨论</p>
                @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
                <a type="button" href="#" class="btn btn-primary">添加</a>
                @endif
            </div>
            <hr>
            <div>
            </div>
        </div>
    </div>

@endsection