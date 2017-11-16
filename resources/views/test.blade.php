
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>jQuery日期/日历插件Ion.Calendar演示-输入框插件</title>
    <link rel="stylesheet" href="{{asset('org/rili/css/ion.calendar.css')}}">
    <style>
        .jq22 { margin-top: 100px;  text-align: center;}
        .jq22 .date { width: 200px; padding: 5px; font-family: Arial, Helvetica, sans-serif;}
    </style>
</head>

<body>
<h1>输入框插件</h1>

<div class="jq22">
    <input type="text" class="date" placeholder="请选择日期">
</div>

<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="{{asset('org/rili/js/moment.min.js')}}"></script>
<script src="{{asset('org/rili/js/moment.zh-cn.js')}}"></script>
<script src="{{asset('org/rili/js/ion.calendar.min.js')}}"></script>
<script>
    $(function(){
        $('.date').each(function(){
            $(this).ionDatePicker({
                lang: 'zh-cn',
                format: 'YYYY-MM-DD'
            });
        });
    });
</script>
</body>
</html>

