@extends('layouts.layout_user',['user'=>$user])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/album_all.css')}}">
@endsection
@section('writes')
    <div class="album">
        <div class="title text-center">
            所有相册
        </div>
        <hr>
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
                                    <label  class="col-sm-2 control-label">相册名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="album_name" class="form-control" id="inputEmail3" placeholder="相册名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">相册描述</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="album_description" rows="3" placeholder="相册描述"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">权限:</label>
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
        <hr>
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
                                                            <label  class="col-sm-2 control-label">相册名称</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="album_name" class="form-control" id="inputEmail3" value="{{$v->ab_name}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">相册描述</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control" name="album_description" rows="3" placeholder="相册描述">{{$v->abdescription}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">权限:</label>
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
@endsection