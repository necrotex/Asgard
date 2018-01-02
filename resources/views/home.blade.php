@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

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
    </div>
</div>
@endsection
