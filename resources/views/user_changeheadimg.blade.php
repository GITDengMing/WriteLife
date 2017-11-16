@extends('layouts.layout_useredit',['op'=>'1'])
@section('ue_css')
    {{--<link rel="stylesheet" href="{{asset('css/edituser.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" />
    {{--<style>--}}
        {{--#preview, .img, img--}}
        {{--{--}}
            {{--width:300px;--}}
            {{--height:300px;--}}
        {{--}--}}
        {{--#preview--}}
        {{--{--}}
            {{--border:1px solid #ccc;--}}
        {{--}--}}
        {{--.file {--}}
            {{--position: relative;--}}
            {{--display: inline-block;--}}
            {{--background: #D0EEFF;--}}
            {{--border: 1px solid #99D3F5;--}}
            {{--border-radius: 4px;--}}
            {{--padding: 4px 12px;--}}
            {{--overflow: hidden;--}}
            {{--color: #1E88C7;--}}
            {{--text-decoration: none;--}}
            {{--text-indent: 0;--}}
            {{--line-height: 20px;--}}
        {{--}--}}
        {{--.file input {--}}
            {{--position: absolute;--}}
            {{--font-size: 100px;--}}
            {{--right: 0;--}}
            {{--top: 0;--}}
            {{--opacity: 0;--}}
        {{--}--}}
        {{--.file:hover {--}}
            {{--background: #AADFFD;--}}
            {{--border-color: #78C3F3;--}}
            {{--color: #004974;--}}
            {{--text-decoration: none;--}}
        {{--}--}}
    {{--</style>--}}
@endsection
@section('modify_user')
    <script type="text/javascript" src="{{asset('js/cropbox.js')}}"></script>
    <h1 style="font-size: 30px;font-weight: 500"><span class="glyphicon glyphicon-picture" style="margin-right: 5px"></span>修改头像</h1>
    <hr>
    <form action="{{url('user/changeheadimg')}}" name="form" role="form" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        <div class="imageBox">
            <div class="thumbBox"></div>
            <div class="spinner" style="display: none">Loading...</div>
        </div>
        <div class="action">
            <!-- <input type="file" id="file" style=" width: 200px">-->
            <div class="new-contentarea tc"> <a href="javascript:void(0)" class="upload-img">
                    <label for="upload-file">选择头像</label>
                </a>
                <input type="file" class="" name="file" id="upload-file" />
            </div>
            <button class="Btnsty_peyton" id="modify_btn" type="submit">修改</button>
            <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
            <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
        </div>
    </form>
    <script type="text/javascript">
        $(window).load(function() {
            var options =
                {
                    thumbBox: '.thumbBox',
                    spinner: '.spinner',
                    imgSrc: '{{$user->head_img}}'
                }
            var cropper = $('.imageBox').cropbox(options);
            $('#upload-file').on('change', function(){
                var reader = new FileReader();
                reader.onload = function(e) {
                    options.imgSrc = e.target.result;
                    cropper = $('.imageBox').cropbox(options);
                }
                reader.readAsDataURL(this.files[0]);
                this.files = [];
            })
            $('#btnCrop').on('click', function(){
                var img = cropper.getDataURL();
                $('.cropped').html('');
                $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
                $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;border-radius:128px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
                $('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');
            })
            $('#btnZoomIn').on('click', function(){
                cropper.zoomIn();
            })
            $('#btnZoomOut').on('click', function(){
                cropper.zoomOut();
            })
            $('#modify_btn').click(function (e) {
                var $s =$('.imageBox').attr('style');
                if (typeof($s) == 'undefined'){
                    alert('请选择头像后再修改');
                    e.preventDefault();
                }else {
                    var $url= "http://oq54yk4ue.bkt.clouddn.com";
                    var $after =$s.slice(23,55);
                    if ($url == $after){
                        alert('请选择头像后再修改');
                        e.preventDefault();
                    }
                }
            });
        });
    </script>
@endsection