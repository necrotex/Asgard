@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: New Application Form')
@section('CONTENT_TITLE', 'New Application Form')

@section('content')
    <form action="{{route('forms.store')}}" method="POST">
    <div class="row">
        <div class="col-md-8">

            <div class="form-group">
                <label for="fromName">Name</label>
                <input type="text" class="form-control" id="fromName" name="name">
            </div>

            <div class="form-group">
                <label for="fromDesc">Description</label>
                <textarea class="form-control" id="fromDesc" rows="4" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="fromCorp">Corporation</label>
                <select class="form-control" id="fromCorp" name="corporation_id">
                    @foreach($corporations as $corporation)
                        <option value="{{$corporation->id}}">{{$corporation->name}}</option>
                    @endforeach
                </select>
                <small id="fromCorpHelp" class="form-text text-muted">
                    Each Corporation can have multiple Forms but they can not be shared between them.
                </small>
            </div>


        </div>

        <div class="col-md-2 offset-1">

            <div class="card">
                <div class="card-header">
                    Save
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" value="Save">Save</button>
                </div>
            </div>

        </div>
    </div>

        {{csrf_field()}}
    </form>
@endsection