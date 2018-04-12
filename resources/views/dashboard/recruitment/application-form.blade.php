@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Application')
@section('CONTENT_TITLE', $form->name)


@section('content')
    <div class="row">
        <div class="col-md-10">

            <p>{{$form->description}}</p>

            <hr>

            <form>
                @foreach($form->questions()->orderBy('order')->get() as $question)
                    <div class="form-group">
                        <label for="question-{{$question->id}}">
                            {{$question->question}}
                            @if($question->required)
                                <small class="text-danger align-text-top">*</small>
                            @endif
                        </label>

                        <textarea class="form-control" id="question-{{$question->id}}" name="question-{{$question->id}}" rows="4"></textarea>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>

        </div>
    </div>
@endsection
