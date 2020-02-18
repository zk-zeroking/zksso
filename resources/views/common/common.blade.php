<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="{{ URL::asset('vendor/layui/layui.all.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('vendor/layui/css/layui.css') }}">
    @yield('header','')
</head>
<body class="layui-layout-body" style="margin: 10px">

    <script>
        function parrentTab(url) {
            window.parent.document.getElementById('body').src = url
        }
        var $;
        layui.use('jquery', function(){
            $= layui.jquery

        }($));
    </script>
    @yield('body')
</body>
</html>
