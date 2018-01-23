@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: PROFILE')
@section('CONTENT_TITLE', 'Profile')

@section('content')

        @include('dashboard.partials.profile.characters')

        <div class="col-4">
            <h4>Settings</h4>

            @include('dashboard.partials.profile.select-main-chracter')

            @include('dashboard.partials.profile.discord-account')

            @include('dashboard.partials.profile.reddit-account')
        </div>

    </div>
@endsection


