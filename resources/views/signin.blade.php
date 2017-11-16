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
                                        <li role="presentation" id="btn_signup"><a href="{{url('register')}}">注册</a></li>
                                        <li role="presentation" id="btn_signin" class="active"><a href="{{url('login')}}">登陆</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="login_form com_form" id="signin_div">
                            <form action="{{url('login')}}" method="post">
                                {{csrf_field()}}
                                <div class="for_err_pos"><input type="text" class="form-control"  name="phoneNum" placeholder="手机号" value="{{session('phone')}}"><span class="errorInfo">{{session('err_pp')}}</span></div>
                                <div class="for_err_pos"><input type="password" class="form-control"  name="password" placeholder="密码" value="{{session('password')}}"><span class="errorInfo"></span></div>
                                {{--验证码--}}
                                <div class="for_err_pos">
                                    <input type="text" name="captcha" class="form-control" placeholder="验证码" style="width: 148px;display: inline-block" id="yzm">
                                    <span class="errorInfo" style="left: 84px">
                                        @if(session('err'))
                                            {{session('err')}}
                                        @endif
                                    </span>
                                <a onclick="javascript:re_captcha();" ><img src="{{ URL('kit/captcha/1') }}"  alt="验证码" title="刷新图片" width="150px" height="46px" id="c2c98f0de5a04167a9e427d883690ff6" border="0"></a>
                                </div>
                                <script>
                                    function re_captcha() {
                                        $url = "{{ URL('kit/captcha') }}";
                                        $url = $url + "/" + Math.random();
                                        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
                                    }
                                </script>
                                {{--验证码结束--}}
                                <button type="submit" id="signin_btn" class="btn btn-info form-control">登陆</button>
                                </form>
                                <p><a href="#">无法登陆？</a></p>
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