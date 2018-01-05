@extends('layouts.frontend')

@section('content')

    <div class="card card-container">

        <img id="profile-img" class="profile-img-card" src="/img/logo.png"/>

        <form class="form-signin" method="post" action="{{ route('login') }}">
            {{ csrf_field() }}

            <span id="reauth-email" class="reauth-email"></span>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                <input type="email" id="inputEmail" name="email" class="form-control" value="{{ old('email') }}"
                       placeholder="Email address" required autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password"
                       required>

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>


            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form><!-- /form -->
        <a href="{{ route('password.request') }}" class="forgot-password text-center">
            Forgot the password?
        </a>

        <a href="{{ route('register') }}" class="text-center forgot-password">
            Register
        </a>
    </div>

@endsection
