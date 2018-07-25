@extends('layouts.dashboard')

@section('PAGE_TITLE', 'HOME')
@section('CONTENT_TITLE', 'HOME')

@section('content')

    @if(auth()->user()->isA('recruit'))

        @if(optional(auth()->user()->application()->whereActive(true)->latest())->exists())
            @include('dashboard.partials.home.recruitment-after-application')
        @else
            @include('dashboard.partials.home.recruitment-notice')
        @endif

    @endif

    @if(count(auth()->user()->characters) == 0)
        @include('dashboard.partials.home.add-characters')
    @endif

    <div class="row">
        <div class="col-5">

        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <h5>System Messages</h5>
                </div>
                <ul class="list-group list-group-flush">

                    @foreach($messages as $message)
                        @include('dashboard.partials.home.log-' . $message->log_name)
                    @endforeach
                </ul>

            </div>

            <div class="card-body">
                {{ $messages->links() }}
            </div>
        </div>

@endsection
