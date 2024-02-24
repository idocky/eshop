@extends('layout')

@section('title')
    Вход в аккаунт | Anion.ua
@endsection

@section('content')

    <div class="login-container">
        <h1 class="login-title">@lang('main.signup')</h1>
        {!! Form::open(['route' => 'register', 'method' => 'post', 'novalidate' => true]) !!}
      
        <label for="name">@lang('main.full_name'):</label>
        <input type="text" id="name" name="name" class="login-input @error('name') is-invalid @enderror" required>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="email">@lang('main.email'):</label>
        <input type="email" id="email" name="email" class="login-input @error('email') is-invalid @enderror" required>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="password">@lang('main.password'):</label>
        <input type="password" id="password" name="password" class="login-input @error('password') is-invalid @enderror" required minlength="6">
        <small>@lang('main.min_char')</small><br/><br/>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="password_confirmation">@lang('main.confirm_password'):</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="login-input" required>

        <input type="submit" value="@lang('main.registration')" class="login-submit" style="background-color: #000000;">
        {!! Form::close() !!}


    </div>
@endsection
