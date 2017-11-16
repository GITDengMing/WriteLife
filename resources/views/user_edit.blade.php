@extends('layouts.layout_useredit',['op'=>'0'])
@section('ue_css')
    <link rel="stylesheet" href="{{asset('css/edituser.css')}}">
    <link rel="stylesheet" href="{{asset('org/rili/css/ion.calendar.css')}}">
@endsection
@section('modify_user')
    <div class="edit_area">
        <div class="opr_title">
            <p class="opr_title_content"><span class="glyphicon glyphicon-cog"></span>编辑个人资料</p>
            <hr>
                <form class="form-horizontal" role="form" action="{{url('user/edit')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">性别</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="gender">
                                @if($user->sex == '')
                                    <option value="unselected" selected="selected">未选择</option>
                                    <option value="male">男</option>
                                    <option value="female">女</option>
                                @elseif($user->sex =='男')
                                    <option value="unselected" >未选择</option>
                                    <option value="male" selected="selected">男</option>
                                    <option value="female">女</option>
                                @else
                                    <option value="unselected" >未选择</option>
                                    <option value="male">男</option>
                                    <option value="female" selected="selected">女</option>
                                @endif

                            </select>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-6">
                            <input type="email" value="{{$user->email}}" class="form-control" id="inputEmail3" name="email" placeholder="邮箱">
                        </div>
                        <div class="col-sm-4">如：13767267543@163.com</div>
                    </div>
                    <div class="form-group">
                        <label for="nick_name" class="col-sm-2 control-label">昵称</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$user->nick_name}}" class="form-control" name="nickname" id="nick_name" placeholder="昵称">
                        </div>
                        <div class="col-sm-4">
                            如：小明
                            <div class="alert alert-warning alert-dismissable" style="margin-bottom: 0px;display: inline-block">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="real_name" class="col-sm-2 control-label">真实姓名</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$user->real_name}}" class="form-control" name="realname" id="real_name" placeholder="真实姓名">
                        </div>
                        <div class="col-sm-4">
                            如：邓小铭
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="col-sm-2 control-label">手机号码</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  id="phone_number" value="{{$user->phone_number}}" disabled="disabled" >
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="birthday" class="col-sm-2 control-label">生日</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$user->birthday}}" class="form-control date" minlength="10" maxlength="10" name="birthday" id="birthday" placeholder="生日">
                        </div>
                        <div class="col-sm-4">
                            请输入形如1996-01-21 的日期
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="brief_introduction" class="col-sm-2 control-label">简介</label>
                        <div class="col-sm-6">
                            <textarea name="brief_introduction" class="form-control" cols="50" rows="3" placeholder="简介">{{$user->brief_introduction}}</textarea>
                        </div>
                        <div class="col-sm-4">
                            介绍自己的一两句话
                        </div>
                    </div>
                    <div class="">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-info" style="margin-left: -15px;">应用修改</button>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </form>
        </div>
    </div>

@endsection
@section('ue_script')
    <script src="{{asset('org/rili/js/moment.min.js')}}"></script>
    <script src="{{asset('org/rili/js/moment.zh-cn.js')}}"></script>
    <script src="{{asset('org/rili/js/ion.calendar.min.js')}}"></script>
    <script>
        $(function(){
            $('div.alert-warning').hide();
            $('.date').each(function(){
                $(this).ionDatePicker({
                    lang: 'zh-cn',
                    format: 'YYYY-MM-DD'
                });
            });

            $(function () {
                $('button.btn-info').click(function (e) {
                    var nick = $('#nick_name').val();
                    if ($.trim(nick) == ''){
                        $('div.alert-warning').show();
                        $('div.alert-warning').html('昵称不能少哦');
                        e.preventDefault();
                    }

                });
            })
            $("#nick_name").focus(function () {
                $('div.alert-warning').hide();
            });
            $("input[name='birthday']").keydown(function (e) {
                if (e.which==8){
                    return false;
                }
            });
        });
    </script>
    @endsection

