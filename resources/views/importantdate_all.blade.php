@extends('layouts.layout_user')
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/importantdate_all.css')}}">
@endsection
@section('writes')
    <div class="illustrate text-center">
        <p>所有重要日子</p>
    </div>
    <div class="create_impdate_btn text-center">
        <a type="button" href="{{url('imp_date/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-pencil">&nbsp;</span>添加重要日子</a>
    </div>
    <hr>
    @if(isset($data))
        @foreach($data as $v)
            <div class="importantdate">
                <p class="content"><b>日期：</b><span class="text-primary">{{$v->date}}</span></p>
                <hr>
                <div class="content">
                    <label>描述:</label>
                    <p class="text-danger">{{$v->description}}</p>
                </div>
                <hr>
                <div class="content">
                    <label>备注:</label>
                    <p class="text-info">{{$v->remark}}</p>
                    <hr>
                </div>
                <div class="text-center">
                    <a href="{{url('imp_date/'.$v->id.'/edit')}}" class="btn btn-warning" style="width: 100px"><span class="glyphicon glyphicon-refresh">&nbsp;</span>修改</a>
                    <a href="{{url('imp_date/'.$v->id.'/delete')}}" class="btn btn-danger delete"   style="width: 100px"><span class="glyphicon glyphicon-trash">&nbsp;</span>删除</a>

                </div>
            </div>
        @endforeach
    @endif
    <script type="text/javascript">
        $(function () {
            $('.delete').on('click', function(e){
                if(confirm("真的要删除吗?")){

                }
                else{
                    e.preventDefault();
                }
            })
        })
    </script>
@endsection