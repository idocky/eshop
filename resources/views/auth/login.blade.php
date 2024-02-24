@extends('layout')

@section('title')
    Вход | Anion.ua
@endsection

@section('content')
    <div class="login-container">
        <h1 class="login-title">@lang('main.login')</h1>
        {!! Form::open(['route' => 'login', 'method' => 'post', 'novalidate' => true]) !!}
            <label for="email">@lang('main.email'):</label>
            <input type="email" id="email" name="email" class="login-input" value="{{ old('email') }}" required>
            <label for="password">@lang('main.password'):</label>
            <input type="password" id="password" name="password" class="login-input" required>
            <input type="submit" value="@lang('main.log')" class="login-submit" style="background-color: #000000;">
        {!! Form::close() !!}
        <div class="d-flex justify-content-between">
            <a href="{{ url('register') }}" class="login-link nav-link">@lang('main.registration')</a>
{{--            <a href="#" class="login-link nav-link">Забыли пароль?</a>--}}
        </div>

    </div>
@endsection
