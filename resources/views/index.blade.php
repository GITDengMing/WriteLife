@extends('layouts.layout',['cat'=>0])
@section('css')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    @endsection
@section('main')
    <div class="container">
        <div class="row ">
            <div class="col-md-8">
                <div id="myCarousel" class="carousel slide" style="margin-bottom: 30px" data-ride="carousel">
                    <!-- 轮播（Carousel）指标 -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <!-- 轮播（Carousel）项目 -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <a href="{{url('article/1/detail')}}"><img src="{{asset('image/3.jpg')}}" alt="First slide" style="height: 300px;width: 100%"></a>
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="item">
                            <a href="{{url('article/19/detail')}}"><img src="{{asset('image/2.jpg')}}" alt="Second slide" style="height: 300px;width: 100%"></a>
                            <div class="carousel-caption"></div>
                        </div>
                        <div class="item">
                            <a href="{{url('article/15/detail')}}"><img src="{{asset('image/1.jpg')}}" alt="Third slide" style="height: 300px;width: 100%"></a>
                            <div class="carousel-caption"></div>
                        </div>
                    </div>
                    <!-- 轮播（Carousel）导航 -->
                    <a class="carousel-control left" href="#myCarousel"
                       data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="carousel-control right" href="#myCarousel"
                       data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>


                @foreach($articles as $v)
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
                                <div style="float: left">
                                    @if($v->category->id==1)
                                    <a href="{{url('tnqs')}}">
                                        <span class="glyphicon glyphicon-th-list" style="margin-right: 5px"></span>
                                        {{$v->category->cat_name}}
                                    </a>
                                    @endif
                                        @if($v->category->id==2)
                                            <a href="{{url('zz')}}">
                                                <span class="glyphicon glyphicon-th-list" style="margin-right: 5px"></span>
                                                {{$v->category->cat_name}}
                                            </a>
                                        @endif
                                        @if($v->category->id==3)
                                            <a href="{{url('jl')}}">
                                                <span class="glyphicon glyphicon-th-list" style="margin-right: 5px"></span>
                                                {{$v->category->cat_name}}
                                            </a>
                                        @endif
                                        @if($v->category->id==4)
                                            <a href="{{url('jyjx')}}">
                                                <span class="glyphicon glyphicon-th-list" style="margin-right: 5px"></span>
                                                {{$v->category->cat_name}}
                                            </a>
                                        @endif
                                        @if($v->category->id==5)
                                            <a href="{{url('shmz')}}">
                                                <span class="glyphicon glyphicon-th-list" style="margin-right: 5px"></span>
                                                {{$v->category->cat_name}}
                                            </a>
                                        @endif
                                </div>
                                <div style="float: right; margin-left:15px;">评论数：{{$v->comments->count()}}</div>
                                <div style="float: right">{{$v->write_time}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{$articles->links()}}
            </div>

            <div class="col-md-4">
                <div class="ranking_list">
                    <div class="rank_name text-center">
                        老油条
                    </div>
                    <hr>
                    <?php $i=0?>
                    @foreach($lyt as $v)

                    <div class="rank_list">
                         {{++$i}}.<a href="{{url('user/'.$v->id)}}">{{$v->nick_name}}</a>
                    </div>
                    @endforeach
                    <?php unset($i)?>
                </div>

                {{--<div class="ranking_list">--}}
                    {{--<div class="rank_name text-center">--}}
                        {{--七嘴八舌--}}
                    {{--</div>--}}
                    {{--<hr>--}}
                    {{--<div class="rank_list">--}}
                        {{--1. <a href="#">标题</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="ranking_list">
                    <div class="rank_name text-center">
                        童年趣事
                    </div>
                    <hr>
                    <?php $i=0?>
                    @foreach($tnqs as $v)
                    <div class="rank_list">
                        {{++$i}}. <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}}</a><span style="margin-left: 5px;color: #aaa;font-size: 13px">评论数：{{$v->comments->count()}}</span>
                    </div>
                    @endforeach
                    <?php unset($i)?>
                </div>
                <div class="ranking_list">
                    <div class="rank_name text-center">
                        生活妙招
                    </div>
                    <hr>
                    <?php $i=0?>
                    @foreach($shmz as $v)
                    <div class="rank_list">
                        {{++$i}}. <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}}</a><span style="margin-left: 5px;color: #aaa;font-size: 13px">评论数：{{$v->comments->count()}}</span>
                    </div>
                    @endforeach
                    <?php unset($i)?>
                </div>
                <div class="ranking_list">
                    <div class="rank_name text-center">
                        经验教训
                    </div>
                    <hr>
                    <?php $i=0?>
                    @foreach($jyjx as $v)
                    <div class="rank_list">
                        {{++$i}}. <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}}</a><span style="margin-left: 5px;color: #aaa;font-size: 13px">评论数：{{$v->comments->count()}}</span>
                    </div>
                    @endforeach
                    <?php unset($i)?>
                </div>
                <div class="ranking_list">
                    <div class="rank_name text-center">
                        经历
                    </div>
                    <hr>
                    <?php $i=0?>
                    @foreach($jl as $v)
                        <div class="rank_list">
                            {{++$i}}. <a href="{{url('article/'.$v->id.'/detail')}}">{{$v->title}}</a><span style="margin-left: 5px;color: #aaa;font-size: 13px">评论数：{{$v->comments->count()}}</span>
                        </div>
                    @endforeach
                    <?php unset($i)?>
                </div>


                <div class="ranking_list">
                    <div class="rank_name text-center">
                        自传
                    </div>
                    <hr>
                    <?php $i=0?>
                    @foreach($zz as $v)
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