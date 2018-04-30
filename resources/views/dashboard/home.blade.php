@extends('layouts.dashboard')

@section('PAGE_TITLE', 'HOME')
@section('CONTENT_TITLE', 'HOME')

@section('content')

        @if(count(auth()->user()->characters) == 0)
            @include('dashboard.partials.home.add-characters')
        @endif

        @if(session()->has('recuritment_code'))
            @include('dashboard.partials.home.recruitment-notice')
        @endif

@endsection
