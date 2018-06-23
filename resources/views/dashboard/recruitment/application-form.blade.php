@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Application')
@section('CONTENT_TITLE', $form->name)


@section('content')
    <div class="row">
        <div class="col-md-12">

            <p>{{$form->description}}</p>

            <hr>

            <div class="alert alert-info">
                <h4>A word of advice</h4>
                <p>Our recruiters like to see potential recruits putting actual effort into the application form. This doesn't mean you need to write a novel,
                    but try to avoid single word answers.</p>
            </div>

            <form method="post" action="{{route('applications.create')}}">
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

                {{csrf_field()}}
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>

        </div>
    </div>
@endsection
