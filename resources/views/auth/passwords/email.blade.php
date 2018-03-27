@extends('layouts.frontend')

@section('content')


    <div class="logo-container">
        <img id="profile-img" class="profile-img-card" src="/img/logo.png"/>

        <h1 class="text-center hero">Friendly Probes
            <small class="auth">Auth</small>
        </h1>
    </div>


    <div class="card card-container">
        <p id="profile-name" class="text-center">Reset Password</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                    <input id="email" type="email" class="form-control" name="email" placeholder="Email adress" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin">
                        Send Password Reset Link
                    </button>
            </div>
        </form>

        <a href="{{ route('login') }}" class="text-center forgot-password">
            back
        </a>
    </div>

@endsection
