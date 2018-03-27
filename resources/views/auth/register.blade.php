@extends('layouts.frontend')


@section('content')

    <div class="logo-container">
        <img id="profile-img" class="profile-img-card" src="/img/logo.png"/>

        <h1 class="text-center hero">Friendly Probes
            <small class="auth">Auth</small>
        </h1>
    </div>

    <div class="card card-container">

        <p id="profile-name" class="text-center">Register</p>

        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                    <input id="name" type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif

            </div>

            <div class="form-group">

                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin">
                        Register
                    </button>

            </div>
        </form>


        <a href="{{ route('login') }}" class="text-center forgot-password">
            back
        </a>
    </div>

@endsection

