@extends('layouts.layout_user',['user'=>$data['user']])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/article_create.css')}}">
@endsection
@section('writes')
    <div id="create_article">
        <div class="illustrate">
            <p>修改{{$cat_name}}</p>
            <hr>
        </div>
        <div id="article_content">
            <form action="{{url('article/'.$data['article']->id.'/edit')}}" method="post" role="form">
                {{csrf_field()}}
                <div class="form-group form-inline art_title">
                    <label class="lable_title">标题:</label>
                    <input type="text" class="form-control" value="{{$data['article']->title}}"  name="title" style="width: 80%">
                    <div id="1" class="alert alert-warning alert-dismissable">
                        <div id="tip_title">
                        </div>
                    </div>
                </div>
                <hr>
                @include('layouts.layout_ueditor',['datatoueditor'=> $data['article']->acontent])
                <div id="2" class="alert alert-warning alert-dismissable">

                    <div id="tip_content">
                    </div>
                </div>
                <input type="submit" value="确认修改" class="btn btn-danger" style="margin-top: 15px">
                <span class="errorInfo">{{session('create_err')}}</span>
            </form>
        </div>
    </div>
@endsection
@section('lu_script')
    <script>
        $(function () {
            $('div.alert-warning').hide();
            $('input.btn-danger').click(function (e) {
                var title = $("input[name='title']").val();
                if ($.trim(title) == ''){
                    $('#1.alert-warning').show();
                    $('#tip_title').html('要有标题哦');
                    e.preventDefault();
                }
                var content = $ue.getContentTxt();
                if ($.trim(content) == ''){
                    $('#2').show();
                    $('#tip_content').html('要有内容哦')
                    e.preventDefault();
                }
            });

            $("input[name]").focus(function () {
                $(this).next('div').hide();
            });
        })
    </script>
@endsection