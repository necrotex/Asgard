@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: CHARACTERS')
@section('CONTENT_TITLE', 'Characters')

@section('content')

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            @foreach($characters as $character)

                <div class="card character-card mb-2">
                    <div class="card-body">

                        <div class="row">

                           <div class="col-md-1">
                               <img class="media-object avatar"
                                    src="https://image.eveonline.com/Character/{{$character->id}}_64.jpg"/>
                           </div>

                            <div class="col-md-10">
                                <h4>{{$character->name}}</h4>
                                <span class="small text-muted">Last updated at: {{$character->updated_at}}</span>

                            </div>

                            <div class="col-md-1 align-baseline">
                                <form method="post" action="{{route('characters.destroy', [auth()->user()->id, $character->id])}}">
                                    {{csrf_field()}}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                </button>

                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                      Add Character
                </div>
                <div class="card-body">
                    <div class="">Please add all Characters on all accounts here.</div>

                    <a href="{{route('sso.login')}}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Add <Charcater></Charcater></a>
                </div>
            </div>

        </div>
    </div>

@endsection

