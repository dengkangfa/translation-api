@extends('layout')

@section('content')
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
@stop

@section('script')
    <script type="text/javascript">
        function copy()
        {
            var Url2=document.getElementById("translation");
            Url2.select(); // 选择对象
            document.execCommand("Copy"); // 执行浏览器复制命令
            alert("已复制好，可贴粘。");
        }
    </script>
@stop
