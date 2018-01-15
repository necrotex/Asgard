@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: SETTINGS')
@section('CONTENT_TITLE', 'Settings')

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            @foreach($corporations as $corporation)
                <div class="card character-card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-1">
                                <img class="media-object avatar"
                                     src="https://image.eveonline.com/Corporation/{{$corporation->id}}_64.png"/>
                            </div>

                            <div class="col-md-10">
                                <b>{{$corporation->name}}</b>
                            </div>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                </div>
            @endforeach

        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-body">

                    <form action="{{route('corporation.store')}}" method="post">
                        {{csrf_field()}}

                        <input type="text" class="add-corporation" name="corp_id" placeholder="Corporation ID">

                        @if($errors)
                            <span class="help-block">
                                <strong>{{ $errors->first('corp_id') }}</strong>
                            </span>
                        @endif


                        <button type="submit" class="btn btn-primary btn-lg btn-block">Add</button>


                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection