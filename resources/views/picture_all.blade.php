@extends('layouts.layout_user',['user'=>$data['user']])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/picture_all.css')}}">
@endsection
@section('writes')
    <div class="pictures">
        <div class="title text-center">
            <span style="color: #999">{{$data['album']->ab_name}}</span>的照片 <span style="font-size: 17px;color: #888;font-weight: 300">{{$data['album']->pictures->count()}}张</span>
            <p style="font-size: 16px;color: #aaa;">
                {{$data['album']->abdescription}}
            </p>
        </div>
        <hr>
        <div class="text-center">
            @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
            <button class="btn btn-warning btn_op_album" data-toggle="modal" data-target="#modifyModal">
                上传照片
            </button>
            @endif
            <!-- 模态框（Modal） -->
            <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title text-center" id="myModalLabel">
                                上传照片
                            </h4>
                        </div>
                        <form name="form" role="form" onsubmit="return isValidateFile('file');" enctype="multipart/form-data" action="{{url('picture/'.$data['album']->id.'/create')}}" class="form-horizontal" method="post">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div id="preview" class="center-block" style="margin-bottom: 15px">
                                </div>
                                {{--<input type="file" onchange="preview(this)" />--}}
                                <a href="javascript:;" class="file">选择照片
                                    <input type="file" name="file" id="" onchange="preview(this)">
                                </a>
                                <div class="fileerrorTip">
                                </div>
                                <div class="showFileName">
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">照片描述</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="picture_des" class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer text-center">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    取消
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    上传
                                </button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>
        </div>
        <hr>
        <div id="mask">
            <div id="mask_main">
                <div id="big_img_container">
                    <img id="big_img" src="" alt="">
                </div>
                <div class="description">
                    <button id="close_btn"><span class="glyphicon glyphicon-remove" ></span></button>
                    <div>
                        <img src="{{asset('image/touxiang.png')}}" alt="" class="img-circle" style="height: 50px;width: 50px;">
                        <div style="display: inline-block;margin-left: 5px;position: relative;top: 13px;line-height: 25px">
                            <div><a href="{{url('user/'.$data['user']->id)}}">{{$data['user']->nick_name}}</a></div>
                            <div id="time"></div>
                        </div>
                    </div>
                    <hr>
                    <div style="margin-top: 5px;padding: 15px;font-size: 20px;color: #777;" id="des">
                    </div>
                </div>
            </div>
        </div>
        <div class="all_picture">
            <div class="row">
                @foreach($data['album']->pictures as $v)
                <div class="col-md-3">
                    <div class="picture">
                        <div class="thumbnail">
                            <img class="small_img" src="{{$v->url.'?imageView2/1/w/210/h/160/q/75|imageslim'}}" style="cursor: pointer;" alt="">
                            <div hidden="hidden" class="hidden_des">{{$v->pdescription}}</div>
                            <div class="caption text-center"   style="background-color: #f1f1f1">
                               {{$v->time}}
                            </div>
                            @if(session()->has('logged_user') && session('logged_user')->id == $data['user']->id)
                            <div class="pic_op">
                                <a href="{{url('picture/'.$v->id.'/delete')}}" class="btn btn-danger center-block delete">删除</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <script type="text/javascript">
                //关闭按钮的点击事件
                $('#close_btn').click(function () {
                    $('#mask').hide();
                });
                //缩略图的点击事件
                $('.small_img').click(function () {
                    var $url = $(this).attr('src');
                    $('#mask').show().find('img#big_img').attr('src',my_splic($url));
                    var $description=$(this).next('.hidden_des').html();
                    $('#des').html($description);
                   var $time=$(this).siblings('.caption').html();
                   $('#time').html($time);
                });
                //分割缩略图的url
                function my_splic($string) {
                    var url = $string.slice(0,$string.length-40);
                    return url;
                }


                    function isValidateFile(obj) {
                        var extend = document.form.file.value.substring(document.form.file.value.lastIndexOf(".") + 1);
                        if (extend == "") {
                            alert("请选择图片！");
                            return false;
                        }
                        else {
                            if (!(extend == "jpg" || extend == "png" || extend =="gif")) {
                                alert("请上传后缀名为jpg、png或gif的文件!");
                                return false;
                            }
                        }
                        return true;
                    };
                $(".file").on("change","input[type='file']",function(){
                    var filePath=$(this).val();
                    if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1){
                        $(".fileerrorTip").html("").hide();
                        var arr=filePath.split('\\');
                        var fileName=arr[arr.length-1];
                        $(".showFileName").html(fileName);
                    }else{
                        $(".showFileName").html("");
                        $(".fileerrorTip").html("您未上传文件，或者您上传文件类型有误！").show();
                        return false
                    }
                });
                function preview(file)
                {
                    var prevDiv = document.getElementById('preview');
                    if (file.files && file.files[0])
                    {
                        var reader = new FileReader();
                        reader.onload = function(evt){
                            prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
                        }
                        reader.readAsDataURL(file.files[0]);
                    }
                    else
                    {
                        prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
                    }
                }
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
    </div>
@endsection
