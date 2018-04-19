@extends('layouts.frontend')

@section('content')

    <div class="logo-container">
        <img id="profile-img" class="profile-img-card" src="/img/logo.png"/>

        <h1 class="text-center hero">500</h1>
        <h1 class="text-center hero">Sever Error</h1>

        @if($exception->getMessage())
            <div class="alert alert-light text-center" role="alert">
                {{$exception->getMessage()}}
            </div>
        @endif
    </div>


@endsection
