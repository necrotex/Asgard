@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: Application Form')
@section('CONTENT_TITLE', 'Application Form: ' . $form->name)

@section('content')
    <form action="{{route('forms.store')}}" method="POST">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{$form->name}}
                    </div>
                    <div class="card-body">
                        {{$form->description}}
                    </div>
                    <div class="card-footer">
                        {{$form->corporation->name}}
                    </div>
                </div>

            </div>

            <div class="col-md-2 offset-1">

                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="Save">Edit</button>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="Save">Add Question</button>
                    </div>
                </div>

            </div>
        </div>

        {{csrf_field()}}
    </form>
@endsection