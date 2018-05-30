@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Application')
@section('CONTENT_TITLE', 'Application: ' . $application->applicant->mainCharacter->name)


@section('content')
    <div class="row">
        <div class="col-md-7">

            @include('dashboard.partials.profile.characters', ['user' => $application->applicant])

            <h3>Questions</h3>

            @foreach($application->questions as $question)
                <div class="card">
                    <div class="card-header">
                        {{$question->question}}
                    </div>

                    <div class="card-body">
                        {{$question->answer}}
                    </div>

                </div>

            @endforeach

        </div>

    </div>
@endsection

