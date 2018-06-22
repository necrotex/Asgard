@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Application')
@section('CONTENT_TITLE', 'Application: ' . $application->applicant->mainCharacter->name)


@section('content')
    <div class="row">
        <div class="col-md-7">

            @include('dashboard.partials.profile.characters', ['user' => $application->applicant])

            <hr>

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

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Info
                </div>

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Invite Created</dt>
                        <dd class="col-sm-9">{{$application->invite->invite->created_at}} by
                            <b>{{$application->invite->invite->creator->mainCharacter->name}}</b></dd>

                        <dt class="col-sm-3">Applied on</dt>
                        <dd class="col-sm-9">{{$application->created_at}}</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            <select id="application-status" class="w-75" name="application_status">
                                @foreach($statuses as $status)
                                    <option name="{{$status->slug}}">{{$status->title}}</option>
                                @endforeach
                            </select>

                            <input type="submit" class="btn btn-sm btn-primary small" value="Save">
                        </dd>

                    </dl>
                </div>
            </div>

            <hr>

            <label for="comment">Comment</label>
            <textarea class="form-control" name="comment"></textarea>
            <input type="submit" class="btn btn-block btn-primary mt-1" value="Save">


            @foreach($application->comments as $comment)
                <div class="card">
                    <div class="card-body @if($comment->system_message) .bg-light @endif">
                        {{$comment->comment}}
                    </div>

                    <div class="card-footer">
                        @if(!$comment->system_message)
                            {{$comment->author->mainCharacter->name}} on {{$comment->created_at}}
                        @endif
                    </div>
                </div>

            @endforeach
        </div>

    </div>
@endsection

@push('js')

    <script>
        $(document).ready(function () {
            $('#application-status').select2({
                width: 'resolve'
            });
        });
    </script>

@endpush