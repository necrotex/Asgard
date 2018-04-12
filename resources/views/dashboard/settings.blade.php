@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Settings')
@section('CONTENT_TITLE', 'Settings')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="card-header">
                    Subreddit Moderator Account
                </div>
                <div class="card-body">

                    @if(!$account)

                        <a href="{{route('services.reddit.redirect_modaccount')}}">Add reddit account</a>
                    @else

                        <div class="row">
                            <div class="col-md-10">{{$account}}</div>

                            <div class="col-md-1 status-col">
                                <div class="status status-success pull-right">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </div>
                            </div>

                        </div>

                    @endif

                </div>
            </div>

        </div>

    </div>
@endsection
