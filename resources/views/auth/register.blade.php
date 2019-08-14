@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <input id="password" type="password" name="password" required placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <input id="password-confirm" type="password" name="password_confirmation" required placeholder="Confirm Password">

                        <button type="submit" >
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
