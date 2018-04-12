@extends('layouts.dashboard')

@section('PAGE_TITLE', 'HOME')
@section('CONTENT_TITLE', 'HOME')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="card-body">

                    @if(!$account)

                        <a href="{{route('services.reddit.redirect')}}">Add reddit account</a>
                    @else

                        <div class="row">
                            <div class="col-md-10">{{$account->nickname}}</div>

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
