<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上面3个meta标签必须放在最前面-->

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/signin.css')}}">
    <title>书写人生—精彩人生，由你书写</title>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 ">
                <div id="sign">
                    <div class="header">
                        <img src="{{asset('image/logo-big.png')}}" class="img-responsive" alt="Responsive image">
                        <h2>精彩人生，由你书写</h2>
                    </div>
                    <div class="signform form-group-lg">
                        <div class="nav_tab">
                            <div class="nav_sider">
                                <ul class="nav nav-pills">
                                        <li role="presentation" id="btn_signup" class="active"><a href="{{url('register')}}">注册</a></li>
                                        <li role="presentation" id="btn_signin" ><a href="{{url('login')}}">登陆</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="signup_div" class="com_form">
                            {{--{{session('input')}}--}}
                            <form action="{{url('register')}}" method="post">
                                {{csrf_field()}}
                                <div class="for_err_pos"><input type="text" class="form-control"  name="reg_name" value="{{session('name')}}" placeholder="姓名"><span class="errorInfo"></span></div>
                                <div class="for_err_pos"><input type="text" class="form-control" name="reg_phone" value="{{session('phone')}}" placeholder="手机号"><span class="errorInfo">{{session('Registered')}}</span></div>
                                <div class="for_err_pos"><input type="password" class="form-control" name="reg_password" value="{{session('password')}}" placeholder="密码(不少于6位)"><span class="errorInfo"></span></div>
                                <div class="for_err_pos"><input type="password" class="form-control" name="reg_confirm" value="{{session('password')}}" placeholder="确认密码"><span class="errorInfo"></span></div>
                                <div class="for_err_pos">
                                    <input type="text" style="display: inline-block;width: 148px;margin-top: 4px" class="form-control" name="sms" placeholder="4位验证码"><span class="errorInfo" style="left: 84px">{{session('sms_err')}}</span>
                                    <button id="sms_btn" class="btn btn-info" style="width: 150px;height: 46px;margin: 0;position: relative;top: -2px;line-height: 36px">获取验证码</button>
                                </div>
                                <button type="submit" id="signup_btn" class="btn btn-info form-control">注册</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <div class="footer" id="footer" style="background-color: #fff;margin-top: 25px;padding: 15px">
        <div class="container">
            <div class="row" style="color: #8a8a8a">
                <div class="col-md-6">
                    <h5 >人生这一世，走这一路，经这一场，在这一路上所见的人和所遇到的风景还有所经历的事情，就像我们读过的好书和看过的美画，让人在回味的时候仍然难忘，想要珍藏永、久留住这些最宝贵的回忆之美和记忆之花。</h5>
                    <p style="font-size: 18px;">Powered by <a href="https://laravel.com/" target="_blank">Laravel,</a><a
                                href="http://www.bootcss.com" target="_blank">Bootstrap</a></p>
                    <p style="font-size: 18px;">Designed by ❤ 四枝花</p>
                </div>
                <div class="col-md-2">
                    <h5 style="font-size: 22px;color: #777">赞助商</h5>
                </div>
                <div class="col-md-2">
                    <h5 style="font-size: 22px;color: #777">统计信息</h5>
                    <p >平台用户:<span>0</span></p>
                </div>
                <div class="col-md-2">
                    <h5 style="font-size: 22px;color: #777">友情链接</h5>
                    <p><a href="http://glyphicons.com">Glyphicons</a></p>
                </div>
            </div>
        </div>
    </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/sign.js')}}"></script>
</body>
</html>