@extends('layouts.index')
@section('title', 'Авторизация')
@section('center')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Авторизация</h2>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Адрес почты" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <input id="password" type="password" name="password" required placeholder="Пароль">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <span>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                        </span>

                        <hr>

                        <button type="submit" class="pull-left">Войти</button>

                        <a class="pull-right" href="{{ route('password.request') }}">
                                    Забыли пароль?
                                </a>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">ИЛИ</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Регистрация</h2>
                        <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                        <script>
                        grecaptcha.ready(function() {
                        grecaptcha.execute('<?php echo config("myconsts.captcha_site_key"); ?>', {action: 'registerUser'})
                        .then(function(token) {
                            //console.log(token);
                            document.getElementById('g-recaptcha-response').value=token;
                        });
                        });
                        </script>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="ФИО" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Адрес почты" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <input id="password" type="password" name="password" required placeholder="Пароль">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <input id="password-confirm" type="password" name="password_confirmation" required placeholder="Повторите пароль">
                        <hr>
                        <button class="pull-left" type="submit" >
                            Регистрация
                        </button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
