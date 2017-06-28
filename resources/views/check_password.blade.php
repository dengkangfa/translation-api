@extends('layout')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('translation.checkPassword') }}" method="post" role="form">
                {{ csrf_field() }}
                <legend>请输入访问密码</legend>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for=""></label>
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="text" class="form-control" name="password" placeholder="密码" required>
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>

                <button type="submit" class="btn btn-primary">确定</button>
            </form>
        </div>
    </div>
@stop