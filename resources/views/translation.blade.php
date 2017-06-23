<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 floating-box">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($translation->type == 'graphic')
                        <h2 class="panel-title">{{ $translation->original['text'] }}</h2>
                        <img src="{{ $translation->original['img'] }}" alt="" style="width: 100%">
                    @elseif($translation->type == 'img')
                        <img src="{{ $translation->original['img'] }}" alt="" style="width: 100%">
                    @else
                        <h2 class="panel-title">{{ $translation->original['text'] }}</h2>
                    @endif
                </div>
                <div class="panel-body">
                    <textarea id="translation" class="form-control" rows="5" readonly>{{ $translation->translation }}</textarea>
                </div>
                <div class="panel-footer">
                    <span onClick="copy()"><i class="glyphicon glyphicon-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="{{ ('js/app.js') }}"></script>
<script type="text/javascript">
    function copy()
    {
        var Url2=document.getElementById("translation");
        Url2.select(); // 选择对象
        document.execCommand("Copy"); // 执行浏览器复制命令
        alert("已复制好，可贴粘。");
    }
</script>
</body>
</html>
