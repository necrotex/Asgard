@extends('layouts.dashboard')

@section('PAGE_TITLE', 'PROFILE')
@section('CONTENT_TITLE', 'Profile')

@section('content')
    <div class="row">

        <div class="col-md-5">
            @include('dashboard.partials.profile.characters')
        </div>

        <div class="col-3">
            @include('dashboard.partials.profile.select-main-chracter')
            @include('dashboard.partials.profile.total-isk')
            @include('dashboard.partials.profile.discord-account')

        </div>

        <div class="col-4">
            @include('dashboard.partials.profile.select-user-roles')

            @can('see-api-token')
                @include('dashboard.partials.profile.api-token')
            @endcan
        </div>

    </div>
@endsection


