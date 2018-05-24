@extends('layouts.dashboard')

@section('PAGE_TITLE', '' . $character->name)
@section('CONTENT_TITLE', $character->name)

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('profile.show', $character->user->id)}}">
                    {{$character->user->mainCharacter->name}}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{$character->name}}
            </li>
        </ol>
    </nav>


    <div class="row">

        <div class="col-10 offset-1">
            <div class="alert alert-warning">
                {{$character->name}} is still updating, check back in a few minutes. If your see this page for longer then 1 hour talk to somebody in charge!
            </div>
        </div>
    </div>


@endsection
