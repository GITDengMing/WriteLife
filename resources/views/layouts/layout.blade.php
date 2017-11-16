<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上面3个meta标签必须放在最前面-->

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    @yield('css')
    <title>书写人生-精彩人生，由你书写</title>

</head>
<body>
<div class="header">
    {{--顶级导航--}}
    <nav class="navbar navbar-default navbar-fixed-top" id="nav_top">
        <div class="container">
                <div class="navbar-header" id="div_logo">
                    {{--下面一行代码只有在屏幕小的时候才起作用--}}
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="{{asset('image/logo-sm.png')}}" class="img-responsive" alt=""></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-left navbar_form">
                        <input type="text" class="form-control" id="search_input"  placeholder="输入你感兴趣的内容">
                        <button type="submit" class="btn btn-default" id="search_btn">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </form>
                    @if(!session()->has('logged_user'))
                    <div class="navbar-right navbar-text" id="lg_re">
                        <a href="{{url('login')}}" class="navbar-link" >注册/登陆</a>
                    </div>
                    @else
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown" id="nav_uname">
                            <a href="#" id="logined_uname" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="{{session('logged_user')->head_img}}" id="logined_uimg" alt="" class="img-circle">@if(session()->has('logged_user')){{ session('logged_user')->nick_name }}@endif<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php $logged_user = session('logged_user') ?>
                                <li><a href="{{url("user/$logged_user->id")}}"><span class="glyphicon glyphicon-user">&nbsp;</span>个人中心</a></li>
                                <li><a href="{{url("user/edit")}}"><span class="glyphicon glyphicon-cog">&nbsp;</span>编辑资料</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{url("logout")}}"><span class="glyphicon glyphicon-log-out">&nbsp;</span>退出</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
    </nav>
    {{--二级导航--}}
    <div role="navigation" id="nav_second" class="navbar navbar-default ">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                @if(isset($cat))
                @if($cat == 0)
                <li role="presentation" class="active"><a href="/">首页</a></li>
                @else
                    <li role="presentation"><a href="/">首页</a></li>
                @endif

                @if($cat == 1)
                <li role="presentation" class="active"><a href="{{url('tnqs')}}">童年趣事</a></li>
                @else
                 <li role="presentation"><a href="{{url('tnqs')}}">童年趣事</a></li>
                @endif


                @if($cat == 5)
                <li role="presentation" class="active"><a href="{{url('shmz')}}">生活妙招</a></li>
                @else
                <li role="presentation"><a href="{{url('shmz')}}">生活妙招</a></li>
                    @endif



                 @if($cat == 4)
                <li role="presentation" class="active"><a href="{{url('jyjx')}}">经验教训</a></li>
                    @else
                        <li role="presentation"><a href="{{url('jyjx')}}">经验教训</a></li>
                    @endif


                    @if($cat == 3)
                <li role="presentation" class="active"><a href="{{url('jl')}}">经历</a></li>
                    @else
                        <li role="presentation"><a href="{{url('jl')}}">经历</a></li>
                        @endif

                    @if($cat == 2)
                <li role="presentation" class="active"><a href="{{url('zz')}}">自传</a></li>
                    @else
                        <li role="presentation"><a href="{{url('zz')}}">自传</a></li>
                    @endif
                    @else
                    <li role="presentation" class="active"><a href="/">首页</a></li>
                    <li role="presentation"><a href="{{url('tnqs')}}">童年趣事</a></li>
                    <li role="presentation"><a href="{{url('shmz')}}">生活妙招</a></li>
                    <li role="presentation"><a href="{{url('jyjx')}}">经验教训</a></li>
                    <li role="presentation"><a href="{{url('jl')}}">经历</a></li>
                    <li role="presentation"><a href="{{url('zz')}}">自传</a></li>
                @endif

            </ul>
        </div>
    </div>
</div>
@section('main')
@show
<div class="footer" id="footer">
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

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    {{--<script src="{{asset('js/layout.js')}}"></script>--}}
    @yield('script')
</body>
</html>