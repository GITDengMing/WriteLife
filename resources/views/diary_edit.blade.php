@extends('layouts.layout_user',['user'=>$data['user']])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/create_diary.css')}}">
    <link rel="stylesheet" href="{{asset('org/rili/css/ion.calendar.css')}}">
@endsection
@section('writes')
<div id="create_diary">
    <div class="illustrate">
        <p>修改日记</p>
        <hr>
    </div>
    <div id="cd_content">
        <form action="{{url('diary/'.$data['diary']->id.'/edit')}}" method="post" role="form">
            {{csrf_field()}}
            <div class="form-group form-inline">
                <label class="label_title">时间:</label>
                <input type="text" class="form-control date" value="{{$data['diary']->dtime}}"name="time" minlength="10" maxlength="10">&nbsp;&nbsp;&nbsp;
                <lable>请按此格式修改时间</lable>
            </div>
            <hr>
            <div class="form-group form-inline">
                <label class="label_title">权限:</label>
                <label class="radio-inline">
                    <input type="radio"  value="1" name="is_open">公开
                </label>
                <label class="radio-inline">
                    <input type="radio"  value="0" name="is_open" checked="checked">不公开
                </label>
            </div>
            <hr>
            @include('layouts.layout_ueditor',['datatoueditor'=> $data['diary']->dcontent])
            <div class="alert alert-warning alert-dismissable">
                <div id="tip">

                </div>
            </div>
            <input type="submit" value="确认修改" class="btn btn-danger" style="margin-top: 15px">
            <span class="errorInfo">{{session('create_err')}}</span>
        </form>
    </div>
</div>
@endsection
@section('lu_script')
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
            $('input.btn-danger').click(function (e) {
                var content = $ue.getContentTxt();
                if ($.trim(content)==''){
                    $('div.alert-warning').show();
                    $('#tip').html('日记要有内容哦');
                    e.preventDefault();
                }
            });

            $("textarea").focus(function () {
                $(this).next("div").hide();
            });
            $("input[name='time']").keydown(function (e) {
                if (e.which==8){
                    return false;
                }
            });
        });
    </script>
@endsection