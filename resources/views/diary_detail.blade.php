@extends('layouts.layout_user',['user'=>$data['user']])

@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/diary_detail.css')}}">
@endsection

@section('writes')
    <div class="diary_detail">
        <div class="">
            <div class="diary_head text-center">
                <span class="name"><a href="{{url('user/'.$data['user']->id)}}">{{$data['user']->nick_name}}</a></span>
                <span>--记于--</span>
                <span class="time">{{$data['diary']->dtime}}</span>
            </div>
            <hr>
            <div class="diary_content">
                {!! $data['diary']->dcontent !!}
            </div>
            <hr>
            @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
            <div class="text-center">
                <a href="{{url('diary/'.$data['diary']->id.'/edit')}}" class="btn btn-warning" style="width: 100px"><span class="glyphicon glyphicon-refresh">&nbsp;</span>修改</a>
                <a href="{{url('diary/'.$data['diary']->id.'/delete')}}" class="btn btn-danger delete"   style="width: 100px"><span class="glyphicon glyphicon-trash">&nbsp;</span>删除</a>
                <script type="text/javascript">
                    $(function () {
                        $('.delete').click(function (e) {
                            if(confirm("真的要删除吗?")){
                            }
                            else{
                                e.preventDefault();
                            }
                        });
                    })
                </script>
            </div>
                @endif
        </div>
    </div>
@endsection