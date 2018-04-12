@extends('layouts.dashboard')

@section('PAGE_TITLE', 'CHARACTERS')
@section('CONTENT_TITLE', 'Characters')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

            <div class="panel-body">
                <a href="{{route('sso.login')}}">Add Account</a>

                <ul class="list-group">

                    @foreach($characters as $character)
                        <li class="list-group-item">
                            <img class="media-object avatar" src="https://image.eveonline.com/Character/{{$character->id}}_64.jpg"/>

                            {{$character->name}}

                            <div class="clearfix"></div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endsection
