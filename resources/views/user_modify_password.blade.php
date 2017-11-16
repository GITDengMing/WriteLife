@extends('layouts.layout_useredit',['op'=>'2'])
@section('ue_css')
    <link rel="stylesheet" href="{{asset('css/user_modify_password.css')}}">
@endsection
@section('modify_user')
<div class="modify_password">
    <div class="title">
       <span class="glyphicon glyphicon-lock" style="line-height: 50px"></span> 修改密码
    </div>
    <hr>
    <div class="main">
        <div >
            手机号：<span id="phone">{{session('logged_user')->phone_number}}</span>
        </div>
        <hr>
        <div id="div_yzm" style="">
            <input type="text" class="form-control yzm" style="width: 100px;display: inline-block" placeholder="4位验证码">
            <button class="btn btn-info" id="get_yzm">获取验证码</button>
            <p style="margin-top: 15px"><button class="btn btn-primary" id="btn_yz">验证</button></p>
        </div>
        <div class="modify" style="display: none">
            <form action="{{url('user/modifyPassword')}}" method="post" id="form_modify_pw">
                {{csrf_field()}}
                <div class="div_pos"><input type="password" class="form-control" id="new_pw" name="new_password" style="width: 25%;margin-bottom: 15px;display: inline-block" placeholder="新密码"><span class="err"></span></div>
                <div class="div_pos"><input type="password" class="form-control" id="confirm_pw" name="confirm_password" style="width: 25%;display: inline-block" placeholder="确认密码"><span class="err"></span></div>
                <button type="submit" id="btn_modify" class="btn btn-warning" style="margin-top: 15px">确认修改</button>
            </form>
        </div>
    </div>
    <script>
        $(function () {
            $('#btn_modify').click(function (e) {
                var newPassword = $('#new_pw').val();
                var confirmpw = $('#confirm_pw').val();
                var $isOk =1;
                if ($.trim(newPassword) == ''){
                    $('#new_pw').next().html('新密码不能为空');
                    $isOk=0;
                }
                if ($.trim(newPassword) == ''){
                    $('#confirm_pw').next().html('确认密码不能为空');
                    $isOk=0;
                }
                if(newPassword.length<6 ||newPassword.length>18){
                    $('#new_pw').next().html('密码为6-18位');
                    $isOk=0;
                }
                if (newPassword != confirmpw){
                    $('#confirm_pw').next().html('密码不一致');
                    $isOk=0;
                }
                if (!$isOk){
                    e.preventDefault();
                }
            });
            $("input[name]").focus(function () {
                $(this).next(".err").text('');
            });




            //获取验证码
            $('#get_yzm').click(function () {
                    var phone = $('#phone').html();
                    $.get('/sms/'+phone,function (data) {
                        if (data == 'success'){
                            alert('短信验证码已发送！')
                        }else {
                            alert('短信验证码发送失败！')
                        }
                    });
            });
            //验证验证码
            $('#btn_yz').click(function () {
                var $yzm=$('input.yzm').val();
                if ($.trim($yzm) == '' || $yzm.length != 4){
                    alert('请输入4位数字验证码') ;
                }else {
                   var phone = $('#phone').html();
                   var yzm = $('.yzm').val();
                    $.get('/verification/'+yzm,{'phone':phone},function (data) {
                        if(data == 'true'){
                            $('div.modify').show();
                            $('div#div_yzm').hide();
                        }else {
                            alert('验证码错误！')
                        }
                    });
                }
            });

        })





    </script>
</div>
@endsection