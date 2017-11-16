@extends('layouts.layout_user',['user'=>$data['user']])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/importantdate_edit.css')}}">
    <link rel="stylesheet" href="{{asset('org/rili/css/ion.calendar.css')}}">
@endsection
@section('writes')
    <div class="edit">
        <div class="illustrate text-center">
            <p>修改重要日子</p>
            <hr>
        </div>
        <div class="edit_content">
            <form action="{{url('imp_date/'.$data['impdate']->id.'/edit')}}">
                {{csrf_field()}}
                <div class="form-group form-inline">
                    <label class="lable_title">日期:</label>
                    <input type="text" class="form-control date" value="{{$data['impdate']->date}}" placeholder="时间" name="date" minlength="10" maxlength="10">&nbsp;&nbsp;&nbsp;
                </div>
                <div class="form-group form-inline common_label_pos" >
                    <label class="lable_title" style="position: relative;top: -50px">描述:</label>
                    <textarea name="description"  id="description" cols="50" rows="3">{{$data['impdate']->description}}</textarea>
                    <div class="alert alert-warning alert-dismissable" id="tip_description" style="display: inline-block;position: relative;top: -35px;margin-bottom: 0px">

                    </div>
                </div>
                <div class="form-group form-inline common_label_pos" >
                    <label class="lable_title" style="position: relative;top: -50px">备注:</label>
                    <textarea name="remarks"  cols="50" rows="3">{{$data['impdate']->remark}}</textarea>
                </div>
                <hr>
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
                var description = $("#description").val();
                if ($.trim(description)==''){
                    $('#tip_description').html('描述是必须的哦');
                    $('#tip_description').show();
                    e.preventDefault();
                }

            });
            $("textarea").focus(function () {
                $(this).next("div").hide();
            });
            $("input[name='date']").keydown(function (e) {
                if (e.which==8){
                    return false;
                }
            });
        });
    </script>
@endsection