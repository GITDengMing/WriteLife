@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/article_detail.css')}}">
    @endsection
@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-9" >
                <div class="detail">
                    <div class="text-center">
                        <h3>{{$data['article']->title}}</h3>
                        <div class="writer_time">
                            <span>{{$data['article']->category->cat_name}}----&nbsp;</span><a href="{{url('user').'/'.$data['writer']->id}}">{{$data['writer']->nick_name}}</a><span class="write_time">{{$data['article']->write_time}}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="article_detail">
                        {!! $data['article']->acontent !!}
                    </div>
                    @if(session()->has('logged_user') && session('logged_user')->id == $data['writer']->id)
                    <hr>
                    <div class="text-center">
                        <a href="{{url('article/'.$data['article']->id.'/edit')}}" class="btn btn-warning" style="width: 100px"><span class="glyphicon glyphicon-refresh">&nbsp;</span>修改</a>
                        <a href="{{url('article/'.$data['article']->id.'/delete')}}" class="btn btn-danger delete"   style="width: 100px"><span class="glyphicon glyphicon-trash">&nbsp;</span>删除</a>

                    </div>
                    @endif
                </div>
                <div class="comment">
                    <div class="comment_header row">
                       <div class="comment_number col-md-2">
                           评论数:{{$data['article']->comments->count()}}
                       </div>
                        {{--<div class="col-md-offset-8 col-md-2 publish_btn">--}}
                            {{--<a href="#" class="btn btn-info"><span class="glyphicon glyphicon-comment">&nbsp;</span>发表评论</a>--}}
                        {{--</div>--}}
                    </div>
                    <hr>
                    <div class="comment_list">
                        @foreach($data['article']->comments->sortByDesc('floor') as $v)
                        <div class="comment_main">
                            <div class="comment_user">
                                <a href="#"><img src="{{$v->user->head_img}}" alt="" class="img-circle">
                                </a>
                                <a href="#">{{$v->user->nick_name}}</a>
                                <span class="comment_floor">#{{$v->floor}}</span>
                                <span class="comment_time">{{$v->time}}</span>
                                @if((session()->has('logged_user') && session('logged_user')->id == $data['writer']->id)){{--本人--}}
                                <a href="{{url('comment/'.$v->id.'/delete')}}" class="btn btn-danger pull-right delete btn_del_comment"><span class="glyphicon glyphicon-trash">&nbsp;</span>删除评论</a>
                                @endif
                            </div>
                            <div class="contentofuser">
                                {{$v->artcontent}}
                            </div>
                            <hr>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="publish_area">
                    <form action="{{url('comment/'.$data['article']->id.'/publish')}}" method="post" >
                        {{csrf_field()}}
                        <textarea name="commnet" id="comment" cols="50" rows="5" style="width: 100%" placeholder="快来评论吧"></textarea>
                        <div class="alert alert-warning alert-dismissable comm" id="tip_comment">
ad
                        </div>
                        <button type="submit" class="btn btn-warning">发表评论</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3" >
                <div class="writer">
                    <div class="writername_right text-center">作者:{{$data['writer']->nick_name}}</div>
                    <hr>
                    <div style="padding: 15px;font-size: 23px;color: #888">
                        {{$data['writer']->brief_introduction}}
                    </div>
                    <hr>
                    <div class="img text-center">
                        <a href="{{url('user').'/'.$data['writer']->id}}"><img class="img-circle" src="{{$data['writer']->head_img}}" alt=""></a>
                        <hr>
                    </div>
                    <div class="op">
                        @if((session()->has('logged_user') && session('logged_user')->id == $data['writer']->id)){{--本人--}}
                            <a href="{{url('user').'/'.$data['writer']->id}}" class="btn btn-info center-block"><span class="glyphicon glyphicon-user">&nbsp;</span>进入个人中心</a>
                        @else{{-- 已登录但非本人或未登陆--}}
                            @if(!(session()->has('logged_user'))){{-- 未登录--}}
                        <a href="{{url('follow/'.$data['writer']->id.'/follow')}}" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus">&nbsp;</span>关注TA</a>
                            @else{{-- 已登录--}}
                                <?php
                                $is_followed= \App\Model\Follow::where([
                                    ['followed_id',$data['writer']->id],
                                    ['uid',session('logged_user')->id]
                                ])->get();
                                ?>
                                @if($is_followed->isEmpty()){{--已登录但未关注--}}
                        <a href="{{url('follow/'.$data['writer']->id.'/follow')}}" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus">&nbsp;</span>关注TA</a>
                                @else{{--已登录并且已关注--}}
                        <a href="{{url('follow/'.$data['writer']->id.'/cancel')}}" type="button" class="btn btn-warning center-block cancel"><span class="glyphicon glyphicon-plus">&nbsp;</span>已关注</a>
                                @endif
                            @endif
                        {{--<a href="" class="btn btn-danger center-block"><span class="glyphicon glyphicon-envelope">&nbsp;</span>私信TA</a>--}}
                        <button class="btn btn-danger center-block" style="width: 100%" data-toggle="modal" data-target="#myModal">
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
                                            发私信给<span style="color: #919191;">{{$data['writer']->nick_name}}</span>
                                        </h4>
                                    </div>
                                    <form action="{{url('private_letter/'.$data['writer']->id.'/send')}}" method="post">
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
                                            <button type="submit" class="btn btn-danger">
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
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('div.alert-warning').hide();
            $('.modal-footer button.btn-danger').click(function (e) {
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



            $('.publish_area .btn-warning').click(function (e) {
                var comment = $('#comment').val();
                if ($.trim(comment) == ''){
                    $('.comm.alert-warning').show();
                    $('#tip_comment').html('你的评论呢？');
                    e.preventDefault()
                }

            });
            $(".publish_area  textarea").focus(function () {
                $('.comm.alert-warning').hide();
            });


            $('.delete').click(function (e) {
                if(confirm("真的要删除吗?")){
                }
                else{
                    e.preventDefault();
                }
            });
            $('a.cancel').click(function (e) {
                if(confirm("真的要取关吗?")){
                }
                else{
                    e.preventDefault();
                }
            });
        });

    </script>
@endsection
