@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/layout_user.css')}}">
    @yield('lu_css')
@endsection

@section('main')
    <div class="container">
        <div class="row">
        <div class="col-md-3">
            <div id="user_brief_info">
                <div id="user_img_name">
                    <div class="pull-left user_in_com">
                        <a href="#"><img src="{{$user->head_img}}" id="big_userimage" class="img-circle" alt=""></a>
                    </div>
                    <div class="pull-right user_in_com">
                        <h4>
                            <a href="{{url('user/'.$user->id)}}">{{$user->nick_name}}</a>
                        </h4>
                        <span>注册于</span><p style="color: #aaa">{{$user->rig_time}}</p>
                    </div>
                </div>
                <hr>
                <div style="padding: 15px;font-size: 23px;color: #888">
                        {{$user->brief_introduction}}
                </div>
                <hr>
                <div id="num_writes" >
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="{{url('follow/'.$user->id.'/followers')}}"class="number" >{{$user->followers->count()}}</a>
                            <a href="{{url('follow/'.$user->id.'/followers')}}" class="num_category">关注</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="{{url('follow/'.$user->id.'/fans')}}"class="number" >{{$user->fans->count()}}</a>
                            <a href="{{url('follow/'.$user->id.'/fans')}}" class="num_category">粉丝</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#"class="number" >{{$user->diary->count()}}</a>
                            <a href="#" class="num_category">日记</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="#"class="number" >{{$user->article->filter(function ($value, $key){
                                return $value->cat_id==1;
                            })->count()}}</a>
                            <a href="#" class="num_category">童年趣事</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#"class="number" >{{$user->article->filter(function ($value, $key){
                                return $value->cat_id==3;
                            })->count()}}</a>
                            <a href="#" class="num_category">经历</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#"class="number" >{{$user->article->filter(function ($value, $key){
                                return $value->cat_id==4;
                            })->count()}}</a>
                            <a href="#" class="num_category">经验教训</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="#"class="number" >{{$user->article->filter(function ($value, $key){
                                return $value->cat_id==2;
                            })->count()}}</a>
                            <a href="#" class="num_category">自传</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#"class="number" >{{$user->article->filter(function ($value, $key){
                                return $value->cat_id==5;
                            })->count()}}</a>
                            <a href="#" class="num_category">生活妙招</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="{{url('album/'.$user->id.'/all')}}"class="number" >{{$user->album->count()}}</a>
                            <a href="{{url('album/'.$user->id.'/all')}}" class="num_category">相册</a>
                        </div>
                    </div>
                    @if(session()->has('logged_user') && session('logged_user')->id == $user->id){{-- 用户已登录，并且是本人--}}
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="#"class="number" >{{$user->imp_date->count()}}</a>
                            <a href="#" class="num_category">重要日子</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="{{url('private_letter/all')}}"class="number" >{{$user->privateLetter->count()}}</a>
                            <a href="{{url('private_letter/all')}}" class="num_category">私信</a>
                        </div>
                    </div>
                    @endif
                </div>
                <hr>
                <div class="user_operation">

                    @if(session()->has('logged_user') && session('logged_user')->id == $user->id){{-- 用户已登录，并且是本人--}}
                    <a href="{{url('user/edit')}}" type="button" class="btn btn-info center-block" style="width: 80%"><span class="glyphicon glyphicon-edit">&nbsp;</span>编辑个人资料</a>
                    @else{{-- 已登录但非本人或未登陆--}}
                        @if(!(session()->has('logged_user'))){{-- 未登录--}}
                    <a href="{{url('follow/'.$user->id.'/follow')}}" type="button" class="btn btn-success center-block" style="width: 80%"><span class="glyphicon glyphicon-plus">&nbsp;</span>关注TA</a>
                        @else{{-- 已登录--}}
                            <?php
                            $is_followed= \App\Model\Follow::where([
                                ['followed_id',$user->id],
                                ['uid',session('logged_user')->id]
                            ])->get();
                            ?>
                            @if($is_followed->isEmpty()){{--已登录但未关注--}}
                    <a href="{{url('follow/'.$user->id.'/follow')}}" type="button" class="btn btn-success center-block" style="width: 80%"><span class="glyphicon glyphicon-plus">&nbsp;</span>关注TA</a>
                            @else{{--已登录并且已关注--}}

                    <a href="{{url('follow/'.$user->id.'/cancel')}}" type="button" class="btn btn-warning center-block cancel" style="width: 80%"><span class="glyphicon glyphicon-plus">&nbsp;</span>已关注</a>
                            @endif
                        @endif

                    {{--<a href="{{url('private_letter/'.$user->id.'/send')}}" type="button" class="btn btn-danger center-block" style="width: 80%"><span class="glyphicon glyphicon-envelope">&nbsp;</span>发私信</a>--}}
                    <button class="btn btn-danger center-block" style="width: 80%" data-toggle="modal" data-target="#myModal">
                        <span class="glyphicon glyphicon-envelope">&nbsp;</span>
                        私信TA
                    </button>
                    <!-- 模态框（Modal） -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title text-center" id="myModalLabel">
                                        发私信给<span style="color: #919191;">{{$user->nick_name}}</span>
                                    </h4>
                                </div>
                                <form action="{{url('private_letter/'.$user->id.'/send')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <textarea name="pri_let_content"  cols="50" rows="8" style="width: 100%;padding: 15px;" placeholder="私信内容"></textarea>
                                    </div>
                                    <div class="alert alert-warning alert-dismissable pri_let" id="tip_content" >

                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            取消
                                        </button>
                                        <button type="submit" id="btn_sendletter" class="btn btn-danger">
                                            发送私信
                                        </button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal -->
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @yield('writes')
        </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/layout_user.js')}}"></script>
    <script>
        $(function () {
            $('div.alert-warning').hide();
            $('.modal-footer button#btn_sendletter').click(function (e) {
                var content = $('.modal-body textarea').val();
                if($.trim(content) == ''){
                    $('.pri_let.alert-warning').show();
                    $('#tip_content').html('私信内容呢？');
                    e.preventDefault();
                }
            });
            $(".modal-body  textarea").focus(function () {
                $('.pri_let.alert-warning').hide();
            });
        })
    </script>
    @yield('lu_script')
@endsection
