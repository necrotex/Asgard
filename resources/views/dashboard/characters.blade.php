@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: CHARACTERS')
@section('CONTENT_TITLE', 'Characters')

@section('content')

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            @foreach($characters as $character)
                <div class="card character-card">
                    <div class="card-body">

                        <div class="row">
                           <div class="col-md-1">
                               <img class="media-object avatar"
                                    src="https://image.eveonline.com/Character/{{$character->id}}_64.jpg"/>
                           </div>

                            <div class="col-md-10">
                                {{$character->name}}
                                <br />
                                {{$character->owner_hash}}

                            </div>

                            <div class="col-md-1 status-col">
                                <div class="status status-success pull-right">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>
            @endforeach


        </div>

        <div class="col-md-4">

            <a href="{{route('sso.login')}}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Add <Charcater></Charcater></a>

        </div>
    </div>

@endsection

