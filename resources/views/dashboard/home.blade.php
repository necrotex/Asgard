@extends('layouts.dashboard')

@section('PAGE_TITLE', 'HOME')
@section('CONTENT_TITLE', 'HOME')

@section('content')

    @if(count(auth()->user()->characters) == 0)
        @include('dashboard.partials.home.add-characters')
    @endif

    @if(auth()->user()->isA('recruit'))
        @include('dashboard.partials.home.recruitment-notice')
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
                        @php
                            switch ($message->log_name) {
                                case 'warning':
                                    $class = 'list-group-item-warning';
                                    break;
                                case 'error':
                                    $class = 'list-group-item-danger';
                                    break;
                                default:
                                    $class = 'list-group-item-primary';
                            }
                        @endphp

                        <li class="list-group-item list-group-item {{$class}}"><b>{{$message->subject->name}}
                                :</b> {{$message->description}} {{optional($message->causer)->name}}<br/>

                            <small class="text-muted">{{$message->created_at}}</small>

                            @if($message->log_name == 'error')
                                <a href="#" class="text-muted" data-toggle="collapse"
                                   data-target="#collapse-{{$message->id}}" aria-expanded="false"
                                   aria-controls="collapse-{{$message->id}}">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <div class="collapse" id="collapse-{{$message->id}}">
                                    <pre>
                                        {{$message->getExtraProperty('exception')}}
                                    </pre>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

@endsection
