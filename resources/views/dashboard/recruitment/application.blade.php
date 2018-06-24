@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Application')
@section('CONTENT_TITLE', 'Application: ' . $application->applicant->mainCharacter->name)


@section('content')

    @if(!$application->active)
        <div class="row">
            <div class="col-12">
                <div class="alert @if($application->status->slug == 'accepted') alert-success @else alert-danger @endif"
                     role="alert">
                    <h4 class="alert-heading">This Application is done, the applicant was
                        <b>{{$application->status->slug}}</b></h4>
                    <p>Hi, this application was completed. IF you need to repoen it please talk to a director.</p>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-7">

            @include('dashboard.partials.profile.characters', ['user' => $application->applicant])

            <hr>

            <h5>Questions</h5>

            @foreach($application->questions as $question)
                <div class="card mb-2">
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
                            @if($application->active)
                                <form method="post" action="{{ route('applications.status', $application) }}">

                                    <select id="application-status" class="w-75" name="application_status">
                                        @foreach($statuses as $status)
                                            <option name="{{$status->slug}}" value="{{$status->id}}"
                                                    @if($status->id == $application->status_id) selected @endif>{{$status->title}}</option>
                                        @endforeach
                                    </select>

                                    {{csrf_field()}}
                                    <input type="submit" class="btn btn-sm btn-primary small" value="Save">
                                </form>
                            @else
                                <b>{{$application->status->title}}</b>
                            @endif
                        </dd>

                    </dl>
                </div>
            </div>

            <hr>

            <h5>Comments</h5>
            @if($application->active)
                <form method="post" action="{{route('applications.comment', $application)}}" class="mb-4">
                    <textarea class="form-control" name="comment"></textarea>

                    {{csrf_field()}}
                    <input type="submit" class="btn btn-block btn-primary mt-1" value="Save">
                </form>
            @endif

            @foreach($application->comments->reverse() as $comment)
                <div class="card mb-2">
                    <div class="card-body border @if($comment->system_message) text-white font-weight-bold bg-primary @endif">
                        {{$comment->comment}}

                        @if($comment->system_message)
                            <br>
                            <span class="small text-white">
                                {{$comment->author->mainCharacter->name}} on {{$comment->created_at}}</span>
                        @endif
                    </div>

                    @if(!$comment->system_message)
                        <div class="card-footer small text-muted">
                            @if($comment->author)
                                {{$comment->author->mainCharacter->name}} on {{$comment->created_at}}
                            @endif
                        </div>
                    @endif
                </div>

            @endforeach
        </div>

    </div>
@endsection

@push('js')

    <script>
        $(document).ready(function () {
            $('#application-status').select2({
                width: 'resolve',
                'minimumResultsForSearch': Infinity,
            });
        });
    </script>

@endpush