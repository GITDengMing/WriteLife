@extends('layouts.layout_user',['user'=>$user])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/diary_user_all.css')}}">
@endsection

@section('writes')
        <div class="illustrate text-center">
            <p>所有日记</p>
        </div>
        <div class="create_diary_btn text-center">
            <a type="button" href="{{url('diary/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil">&nbsp;</span>添加日记</a>
        </div>
        <hr>
        <div class="row">
        @foreach($data as $v)
        <div class=" col-md-3">
            <div class="diary">
            <p class="text-center"><b>日期：</b><a href="{{url('diary/'.$v->id.'/detail')}}">{{$v->dtime}}</a></p>
            </div>
        </div>
        @endforeach
        </div>
        {{$data->links()}}
@endsection
@section('lu_script')
    <script src="{{asset('js/diary_user_all.js')}}"></script>
@endsection