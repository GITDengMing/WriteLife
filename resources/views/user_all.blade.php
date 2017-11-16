@extends('layouts.layout_user',['user'=>$user])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/user_all.css')}}">
    <link rel="stylesheet" href="{{asset('css/album_all.css')}}">
@endsection
@section('writes')
    <div class="user_index">
        <ul id="myTab" class="nav nav-tabs ">
            @if(session()->has('logged_user') &&session('logged_user')->id == $user->id)
            <li class="active">
                <a href="#imp_date" data-toggle="tab">
                    重要日子
                </a>
            </li>
            <li>
                <a href="#pri_letter" data-toggle="tab">
                    私信
                </a>
            </li>
            @endif


            @if(!(session()->has('logged_user') &&session('logged_user')->id == $user->id)){{--非本人--}}
                <li class="active">
                    <a href="#diary" data-toggle="tab">
                        日记
                    </a>
                </li>
            @else
                    <li>
                        <a href="#diary" data-toggle="tab">
                            日记
                        </a>
                    </li>
            @endif
            <li>
                <a href="#tnqs" data-toggle="tab">
                    童年趣事
                </a>
            </li>
            <li>
                <a href="#jl" data-toggle="tab">
                    经历
                </a>
            </li>
            <li>
                <a href="#jyjx" data-toggle="tab">
                    经验教训
                </a>
            </li>
            <li>
                <a href="#shmz" data-toggle="tab">
                    生活妙招
                </a>
            </li>
            <li>
                <a href="#zz" data-toggle="tab">
                    自传
                </a>
            </li>
            <li>
                <a href="#album" data-toggle="tab">
                    相册
                </a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            @if(session()->has('logged_user') &&session('logged_user')->id == $user->id)
            {{--重要日子--}}
            <div class="tab-pane fade in active" id="imp_date">
                @foreach($user->imp_date as $v)
                    <div class="write_simple">
                        <div class="impdate_item">
                            <span class="">日期：</span>{{$v->date}}
                        </div>
                        <div class="impdate_item">
                            <span class="">描述：</span>{{$v->description}}
                        </div>
                        <div class="impdate_item">
                            <span class="">备注：</span>{{$v->remark}}
                        </div>
                        <div class="impdate_op">
                            <a href="{{url('imp_date/'.$v->id.'/edit')}}" class="btn btn-warning ">修改</a>
                            <a href="{{url('imp_date/'.$v->id.'/delete')}}" class="btn btn-danger delete">删除</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <div class="text-center">
                    <a href="{{url('imp_date/create')}}" class="btn btn-primary" style="width: 20%">添加</a>
                </div>
            </div>
            {{--私信--}}

            <div class="tab-pane fade" id="pri_letter">
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
            @endif

            @if(!(session()->has('logged_user') &&session('logged_user')->id == $user->id)){{--非本人--}}
            {{--日记--}}
            <div class="tab-pane fade in active" id="diary">
                @foreach($user->diary as $v)
                    <a href="{{url('diary/'.$v->id.'/detail')}}">{{$v->dtime}}</a>
                    <hr>
                @endforeach
                    @if(session()->has('logged_user') &&session('logged_user')->id == $user->id)
                    <div class="text-center">
                        <a href="{{url('diary/create')}}" class="btn btn-primary" style="width: 20%">添加</a>
                    </div>
                        @endif

            </div>
            @else
                    <div class="tab-pane fade" id="diary">
                        @foreach($user->diary as $v)
                            <a href="{{url('diary/'.$v->id.'/detail')}}">{{$v->dtime}}</a>
                            <hr>
                        @endforeach
                        @if(session()->has('logged_user') && session('logged_user')->id == $user->id)
                        <div class="text-center">
                            <a href="{{url('diary/create')}}" class="btn btn-primary" style="width: 20%">添加</a>
                        </div>
                        @endif
                    </div>
                @endif
            {{--童年趣事--}}
            <div class="tab-pane fade" id="tnqs">
                @foreach($user->article as $v)
                    @if($v->cat_id == 1)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    @if(session()->has('logged_user') &&session('logged_user')->id == $user->id)
                    <div class="text-center">
                        <a href="{{url('article/1/create')}}" class="btn btn-primary" style="width: 20%">添加</a>
                    </div>
                        @endif
            </div>
            {{--经历--}}
            <div class="tab-pane fade" id="jl">
                @foreach($user->article as $v)
                    @if($v->cat_id == 3)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    @if(session()->has('logged_user') &&session('logged_user')->id == $user->id)
                    <div class="text-center">
                        <a href="{{url('article/3/create')}}" class="btn btn-primary" style="width: 20%">添加</a>
                    </div>
                        @endif
            </div>
            {{--经验教训--}}
            <div class="tab-pane fade" id="jyjx">
                @foreach($user->article as $v)
                    @if($v->cat_id == 4)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    @if(session()->has('logged_user') &&session('logged_user')->id == $user->id)
                    <div class="text-center">
                        <a href="{{url('article/4/create')}}" class="btn btn-primary" style="width: 20%">添加</a>
                    </div>
                        @endif
            </div>
            {{--生活妙招--}}
            <div class="tab-pane fade" id="shmz">
                @foreach($user->article as $v)
                    @if($v->cat_id == 5)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    @if(session()->has('logged_user') &&session('logged_user')->id == $user->id)
                    <div class="text-center">
                        <a href="{{url('article/5/create')}}" class="btn btn-primary" style="width: 20%">添加</a>
                    </div>
                    @endif
            </div>
            {{--自传--}}
            <div class="tab-pane fade" id="zz">
                @foreach($user->article as $v)
                    @if($v->cat_id == 2)
                        <a href="{{url('article/'.$v->id.'/detail')}}">{{ $v->title }}</a><span class="write_time">{{$v->write_time}}</span>
                        <hr>
                    @endif
                @endforeach
                    @if(session()->has('logged_user') &&session('logged_user')->id == $user->id)
                    <div class="text-center">
                        <a href="{{url('article/2/create')}}" class="btn btn-primary" style="width: 20%">添加</a>
                    </div>
                        @endif
            </div>
            {{--相册--}}
            <div class="tab-pane fade" id="album">
                @if(session()->has('logged_user') && session('logged_user')->id == $user->id)
                    <div class="album_op">
                        <button class="btn btn-primary center-block" data-toggle="modal" data-target="#myModal">
                            创建新相册
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
                                            创建相册
                                        </h4>
                                    </div>
                                    <form action="{{url('album/create')}}" class="form-horizontal" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label">相册名称</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="album_name" class="form-control" id="inputEmail3" placeholder="相册名称">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-sm-3 control-label">相册描述</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="album_description" rows="3" placeholder="相册描述"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">权限:</label>
                                                <label class="radio-inline">
                                                    <input type="radio"  value="1" name="is_open" checked="checked">公开
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio"  value="0" name="is_open" >不公开
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer text-center">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                取消
                                            </button>
                                            <button type="submit" class="btn btn-danger">
                                                创建
                                            </button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal -->
                        </div>
                    </div>
                @endif
                <div class="albums">
                    <div class="row">
                        @foreach($user->album as $v)
                            @if( !($v->jurisdiction == 0 && ( !session()->has('logged_user') || session('logged_user')->id != $user->id) ))
                                <div class="col-md-4">
                                    <div class="album">
                                        <div class="thumbnail">
                                            <div style="position: relative">
                                                @if($v->pictures->count()!=0)
                                                <a href="{{url('picture/'.$v->id.'/all')}}"><img src="{{$v->pictures->sortByDesc('time')->first()->url.'?imageView2/1/w/210/h/160/q/75|imageslim'}}" alt="相册封面"></a>
                                                <span class="pic_num">{{$v->pictures->count()}}</span>
                                                    @else
                                                    <a href="{{url('picture/'.$v->id.'/all')}}"><img src="" alt=""></a>
                                                @endif
                                            </div>
                                            <div class="caption">
                                                <div class="text-center album_name">
                                                    <a href="{{url('picture/'.$v->id.'/all')}}">{{$v->ab_name}}</a>
                                                </div>
                                                @if(session()->has('logged_user') && session('logged_user')->id == $user->id)
                                                    <hr>
                                                    <div class="album_op">
                                                        <a href="{{url('album/'.$v->id.'/delete')}}" class="btn btn-danger btn_op_album delete" style="float: right">删除相册</a>
                                                        <button class="btn btn-warning btn_op_album" data-toggle="modal" data-target="#modifyModal{{$v->id}}">
                                                            修改相册
                                                        </button>
                                                        <!-- 模态框（Modal） -->
                                                        <div class="modal fade" id="modifyModal{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                            &times;
                                                                        </button>
                                                                        <h4 class="modal-title text-center" id="myModalLabel">
                                                                            修改相册
                                                                        </h4>
                                                                    </div>
                                                                    <form action="{{url('album/'.$v->id.'/edit')}}" class="form-horizontal" method="post">
                                                                        {{csrf_field()}}
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label  class="col-sm-3 control-label">相册名称</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" name="album_name" class="form-control" id="inputEmail3" value="{{$v->ab_name}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label  class="col-sm-3 control-label">相册描述</label>
                                                                                <div class="col-sm-9">
                                                                                    <textarea class="form-control" name="album_description" rows="3" placeholder="相册描述">{{$v->abdescription}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="inputEmail3" class="col-sm-3 control-label">权限:</label>
                                                                                @if($v->jurisdiction == 1){{--如果相册为公开的，默认选中公开--}}
                                                                                <label class="radio-inline">
                                                                                    <input type="radio"  value="1" name="is_open" checked="checked">公开
                                                                                </label>
                                                                                <label class="radio-inline">
                                                                                    <input type="radio"  value="0" name="is_open" >不公开
                                                                                </label>
                                                                                @else{{--否则选中不公开--}}
                                                                                <label class="radio-inline">
                                                                                    <input type="radio"  value="1" name="is_open">公开
                                                                                </label>
                                                                                <label class="radio-inline">
                                                                                    <input type="radio"  value="0" name="is_open" checked="checked">不公开
                                                                                </label>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer text-center">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                                取消
                                                                            </button>
                                                                            <button type="submit" class="btn btn-danger">
                                                                                修改
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal -->
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('.delete').on('click', function(e){
                if(confirm("真的要删除吗?")){

                }
                else{
                    e.preventDefault();
                }
            })
        })
    </script>
@endsection
