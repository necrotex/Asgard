@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Application Form Edit')
@section('CONTENT_TITLE', 'Application Form: Edit')

@section('content')
    <form action="{{route('forms.update', $form)}}" method="POST">
        <div class="row">
            <div class="col-md-8">

                <div class="form-group">
                    <label for="fromName">Name</label>
                    <input type="text" class="form-control" id="fromName" name="name" value="{{$form->name}}">
                </div>

                <div class="form-group">
                    <label for="fromDesc">Description</label>
                    <textarea class="form-control" id="fromDesc" rows="4" name="description">{{$form->description}}</textarea>
                </div>

                <h3>Questions</h3>
                <small class="text-muted">Drag and drop to rearange questions</small>

                <div class="card" class="w-100">
                    <ul class="list-group list-group-flush" id="sortable">
                        @foreach($form->questions()->orderBy('order')->get() as $question)
                            <li class="list-group-item" id="{{$question->id}}">
                                <div class="row">
                                    <div class="col-1 grip">
                                        <i class="fas fa-sort"></i>
                                    </div>

                                    <div class="col-9">
                                        {{$question->question}}
                                    </div>

                                    <div class="col-2">
                                        <a href="{{route('question.edit', $question)}}" class="btn btn-warning btn-xs pull-right small">Edit</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <div class="col-md-2 offset-1">

                <div class="card">
                    <div class="card-body">

                        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#createNewQuestionModal">
                            Add Question
                        </button>

                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="Save">Save</button>
                    </div>
                </div>

            </div>
        </div>

        <input type="hidden" id="sorted" name="sort_order">

        {{csrf_field()}}
    </form>

    @include('dashboard.partials.forms.add-question-modal')
    @include('dashboard.partials.forms.add-question-modal')

@endsection



@push('js')
    <script>
        $( function() {
            $( "#sortable" ).sortable({
                placeholder: "ui-state-highlight",
            });

            $( "#sortable" ).disableSelection();

            $( "#sortable" ).on( "sortupdate", function( event, ui ) {
                var order = $( "#sortable" ).sortable( "toArray" ).join();
                $('#sorted').val(order);
            } );

        } );

    </script>
@endpush