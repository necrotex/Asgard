@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: Application Form')
@section('CONTENT_TITLE', 'Application Form: ' . $form->name)

@section('content')
    <form action="{{route('forms.store')}}" method="POST">
        <div class="row">
            <div class="col-md-8">
                <p>{{$form->description}}</p>

                <hr>
                <h3>Questions</h3>

                <div class="card" class="w-100">
                    <ul class="list-group list-group-flush">
                        @foreach($form->questions()->orderBy('order')->get() as $question)
                            <li class="list-group-item">{{$question->question}}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <div class="col-md-2 offset-1">

                <div class="card">
                    <div class="card-body">
                        <a href="{{route('forms.edit', $form)}}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Edit</a>
                    </div>
                </div>

            </div>
        </div>

        {{csrf_field()}}
    </form>
@endsection
