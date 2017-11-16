<!-- 加载编辑器的容器 -->
    <script id="container" name="my_content" type="text/plain">@if (isset($datatoueditor)){!! $datatoueditor !!}@endif
    </script>
<!-- 配置文件 -->
<script type="text/javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{asset('ueditor/ueditor.all.js')}}"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var $ue = UE.getEditor('container',{
        initialFrameHeight: 250,
    });
    $ue.ready(function () {
        var html = $ue.getContent();
    })
    {{--uParse('#container',{--}}
        {{--rootPath: '{{asset('ueditor')}}'--}}
    {{--});--}}
</script>