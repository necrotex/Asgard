@extends('layouts.frontend')

@section('content')

    <div class="logo-container">
        <img id="profile-img" class="profile-img-card" src="/img/logo.png"/>

        <h1 class="text-center hero">Friendly Probes
            <small class="auth">Auth</small>
        </h1>
    </div>

    <div class="card w-75 mx-auto mt-3">
        <div class="card-body">
            Thank you for your interest in {{$invite->applicationForm->corporation->name}}. Please log in using
            <a href="https://www.eveonline.com/article/eve-online-sso-and-what-you-need-to-know">EVE SSO</a>. No worries,
            we don't see your EVE Online Account Name or Password.
        </div>
    </div>


    <div class="text-center card-container">
        <a href="{{route('sso.site-login')}}">
            <img class="center-block" src="{{asset('img/sso-login.png')}}">
        </a>
    </div>

@endsection
