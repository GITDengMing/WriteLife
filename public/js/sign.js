$(function () {
    $('ul.nav-pills li').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        // $('.com_form').eq($(this).index()).show().siblings('.com_form').hide();
    });
    //登陆验证
    $('#signin_btn').click(function (e) {
        $phoneNum = $("input[name='phoneNum']").val();
        $password = $("input[name='password']").val();
        $captcha =$("input[name='captcha']").val();
        $isOk =1;
        if($phoneNum==''){
           $("input[name='phoneNum']+span").text('请输入手机号');
           $isOk = 0;
        }
        if($password=='') {
            $("input[name='password']+span").text('请输入密码');
            $isOk = 0;
        }
        if ($captcha==''){
            $("input[name='captcha']+span").text('请输入验证码');
            $isOk = 0;
        }
        if ($phoneNum!='' && $phoneNum.length!=11){
            $("input[name='phoneNum']+span").text('手机号为11位');
            $isOk = 0;
        }
        if ($password.length<6){
            $("input[name='password']+span").text('密码不能少于6位');
            $isOk = 0;
        }
        if (!$isOk) {
            e.preventDefault();
        }

    });
    //注册验证
    $('#signup_btn').click(function (e) {
       var $nick_name = $("input[name='reg_name']").val();
        var $phone_num = $("input[name='reg_phone']").val();
       var $password = $("input[name='reg_password']").val();
        var $confirm = $("input[name='reg_confirm']").val();
        var $sms = $("input[name='sms']").val();
        var $isOk =1;
        if($sms==''){
            $("input[name='sms']+span").text('请输入验证码');
            $isOk = 0;
        }
        if($phone_num==''){
            $("input[name='reg_name']+span").text('请输入姓名');
            $isOk = 0;
        }
        if($phone_num==''){
            $("input[name='reg_phone']+span").text('请输入手机号');
            $isOk = 0;
        }
        if($phone_num !='' && $phoneNum.length!=11  ){
            $("input[name='reg_phone']+span").text('请输入11位的手机号');
            $isOk = 0;
        }
        if($password==''){
            $("input[name='reg_password']+span").text('请输入密码');
            $isOk = 0;
        }
        if($confirm==''){
            $("input[name='reg_confirm']+span").text('请输入确认密码');
            $isOk = 0;
        }
        if($confirm !=$password &&$confirm!=''){
            $("input[name='reg_confirm']+span").text('密码不一致');
            $isOk = 0;
        }
        if ($password.length<6){
            $("input[name='reg_password']+span").text('密码不能少于6位');
            $isOk = 0;
        }
        if (!$isOk){
            e.preventDefault();
        }
    });

    $("input[name]").focus(function () {
       $(this).next(".errorInfo").text('');
    });

    $('#sms_btn').click(function (e) {
        var $phone_num = $("input[name='reg_phone']").val();
        if ($.trim($phone_num) == ''){
            alert('请输入手机号码');
        }else{
            $.get('sms/'+$phone_num,function (data) {
                if (data == 'success'){
                    alert('短信验证码已发送！')
                }else {
                    alert('短信验证码发送失败！')
                }
            });
        }
        e.preventDefault();
    });
});
