@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Feedback')
@section('CONTENT_TITLE', 'Feedback')

@section('content')

    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Feedback
                </div>
                <div class="card-body">
                    {!! nl2br(e($feedback->text)) !!}
                </div>

                <div class="card-footer">
                    <small>{{$feedback->created_at}}</small>
                </div>
            </div>
        </div>

        <div class="cold-md-4">
            <div class="card">
                <div class="card-header">
                    User Hash
                </div>

                <div class="card-body">
                    <code>{{$feedback->hash}}</code>
                </div>
            </div>
        </div>
    </div>

@endsection