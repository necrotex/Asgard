@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: PROFILE')
@section('CONTENT_TITLE', 'Profile')

@section('content')
    <div class="row">

        @include('dashboard.partials.profile.characters')

        <div class="col-4">
            <h4>Settings</h4>

            @include('dashboard.partials.profile.select-main-chracter')

            @include('dashboard.partials.profile.discord-account')

            @include('dashboard.partials.profile.reddit-account')


            @include('dashboard.partials.profile.select-user-roles')
        </div>
    </div>

    <div class="row">
        @include('dashboard.partials.profile.info-box')
    </div>
@endsection


