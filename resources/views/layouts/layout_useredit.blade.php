{{--继承布局--}}
@extends('layouts.layout')
{{--引入css--}}
@section('css')
    <link rel="stylesheet" href="{{asset('css/layout_useredit.css')}}">
    @yield('ue_css')
@endsection
{{--主体部分--}}
@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="person_opr">
                    <ul class="opr_list">
                        @if($op == '0')
                            <li class="ue_active"><a href="{{url('user/edit')}}" class="text-center"><span class="glyphicon glyphicon-th-list" style="margin-right: 5px"></span>个人资料</a></li>
                            <li><a href="{{url('user/changeheadimg')}}" class="text-center"><span class="glyphicon glyphicon-picture" style="margin-right: 5px"></span>修改头像</a></li>
                            <li><a href="{{url('user/modifyPassword')}}" class="text-center"><span class="glyphicon glyphicon-lock" style="margin-right: 5px"></span>修改密码</a></li>
                        @elseif($op == '1')
                            <li ><a href="{{url('user/edit')}}" class="text-center"><span class="glyphicon glyphicon-th-list" style="margin-right: 5px">个人资料</a></li>
                            <li class="ue_active"><a href="{{url('user/changeheadimg')}}" class="text-center"><span class="glyphicon glyphicon-picture" style="margin-right: 5px"></span>修改头像</a></li>
                            <li><a href="{{url('user/modifyPassword')}}" class="text-center"><span class="glyphicon glyphicon-lock" style="margin-right: 5px"></span>修改密码</a></li>
                        @else
                            <li ><a href="{{url('user/edit')}}" class="text-center"><span class="glyphicon glyphicon-th-list" style="margin-right: 5px">个人资料</a></li>
                            <li ><a href="{{url('user/changeheadimg')}}" class="text-center"><span class="glyphicon glyphicon-picture" style="margin-right: 5px"></span>修改头像</a></li>
                            <li class="ue_active"><a href="{{url('user/modifyPassword')}}" class="text-center"><span class="glyphicon glyphicon-lock" style="margin-right: 5px"></span>修改密码</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                @yield('modify_user')
            </div>
        </div>
    </div>
@endsection
{{--js引入--}}
@section('script')
    {{--<script src="{{asset('js/useredit.js')}}"></script>--}}
    @yield('ue_script')
@endsection