@extends('layouts.frontend')

@section('content')

    <div class="logo-container">
        <img id="profile-img" class="profile-img-card" src="/img/logo.png"/>

        <h1 class="text-center hero">404</h1>
        <h1 class="text-center hero">Page not Found</h1>

        @if($exception->getMessage())
            <div class="alert alert-light text-ce" role="alert">
                {{$exception->getMessage()}}
            </div>
        @endif
    </div>


@endsection
