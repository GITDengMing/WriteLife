@extends('layouts.layout_user')
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/article_create.css')}}">
@endsection
@section('writes')
    <div id="create_article">
        <div class="illustrate">
            <p>记录{{$catg->cat_name}}</p>
            <hr>
        </div>
        <div id="article_content">
            <form action="{{url('article/'.$catg->id.'/create')}}" method="post" role="form">
                {{csrf_field()}}
                <div class="form-group form-inline art_title">
                    <label class="lable_title">标题:</label>
                    <input type="text" class="form-control" value="" placeholder="标题/主题" name="title" style="width: 80%">
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            &times;
                        </button>
                        <div id="tip_title">

                        </div>
                    </div>
                </div>
                <hr>
                @include('layouts.layout_ueditor')
                <div>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            &times;
                        </button>
                        <div id="tip_content">
                        </div>
                    </div>
                </div>
                <input type="submit" value="完成" class="btn btn-danger" style="margin-top: 15px">

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
                    $('div.alert-warning').show();
                    $('#tip_title').html('要有标题哦');
                    e.preventDefault();
                }
                var content = $ue.getContentTxt();
                if ($.trim(content) == ''){
                    $('#tip_content').show();
                    $('#tip_content').html('要有内容哦')
                    e.preventDefault();
                }
            });
        })
    </script>
@endsection