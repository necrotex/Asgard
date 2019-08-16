@extends('layouts.frontend')

@section('content')

    <div class="logo-container">
        <h1 class="text-center hero">Hostile Probes
            <small class="auth">Auth</small>
        </h1>
    </div>

    <div class="text-center card-container">
        <a href="{{route('sso.site-login')}}">
            <img class="center-block" src="img/sso-login.png">
        </a>
    </div>

@endsection
