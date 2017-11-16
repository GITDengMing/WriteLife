@extends('layouts.layout_user',['user'=>$letter->receive_user])
@section('lu_css')
    <link rel="stylesheet" href="{{asset('css/private_letter_detail.css')}}">
@endsection
@section('writes')
    <div class="letter_detail">
        <div class="text-center title">查看私信</div>
        <hr>
        <div class="letter_main">
            <div class="other_info">
                <a href="{{url('user/'.$letter->send_user->id)}}">{{$letter->send_user->nick_name}}</a> 于 <span style="color: #aaa;">{{$letter->send_time}}</span>&nbsp;发送
            </div>
            <hr>
            <div class="letter_body">
               {{$letter->pri_let_content}}
            </div>
            <div class="op text-center" >
                <a href="{{url('private_letter/'.$letter->id.'/delete')}}" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash">&nbsp;</span>删除私信</a>
                <button class="btn btn-primary" style="width: 15%" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-envelope">&nbsp;</span>
                    回复TA
                </button>
                <!-- 模态框（Modal） -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title text-center" id="myModalLabel">
                                    发私信给<span style="color: #919191;">{{$letter->send_user->nick_name}}</span>
                                </h4>
                            </div>
                            <form action="{{url('private_letter/'.$letter->send_user->id.'/send')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-body">
                                    <textarea name="pri_let_content"  cols="50" rows="8" style="width: 100%;padding: 15px;" placeholder="私信内容"></textarea>
                                </div>
                                <div class="alert alert-warning alert-dismissable pri_let" id="tip_content" >
                                </div>
                                <div class="modal-footer text-center">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        取消
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-send">&nbsp;</span>发送私信
                                    </button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('div.alert-warning').hide();
            $('.modal-footer button.btn-danger').click(function (e) {
                var content = $('.modal-body textarea').val();
                if($.trim(content) == ''){
                    $('.pri_let.alert-warning').show();
                    $('#tip_content').html('私信内容呢？');
                    e.preventDefault();
                }
            });
            $(".modal-body  textarea").focus(function () {
                $('.pri_let.alert-warning').hide();
            });


            $('.delete').click(function (e) {
                if(confirm("真的要删除吗?")){
                }
                else{
                    e.preventDefault();
                }
            });
        })
    </script>
@endsection