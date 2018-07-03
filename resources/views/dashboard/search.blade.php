@extends('layouts.dashboard')

@section('PAGE_TITLE', 'SEARCH')
@section('CONTENT_TITLE', 'Search - "' . $term . '"')

@section('content')
    @foreach($results as $character)
        <div class="card character-card mb-2">
            <div class="card-body">

                <div class="row">

                    <div class="col-md-1">
                        <img class="media-object avatar"
                             src="https://image.eveonline.com/Character/{{$character->id}}_64.jpg"/>
                    </div>

                    <div class="col-md-10">
                        <h4><a href="{{route('characters.show', $character->id)}}">{{$character->name}}</a></h4>
                        <span class="small text-muted">Last updated at: {{$character->updated_at}}</span>
                    </div>

                </div>

            </div>
        </div>
    @endforeach
@endsection
