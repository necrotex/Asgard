@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Question Edit')
@section('CONTENT_TITLE', 'Question: Edit')

@section('content')

        <form action="{{route('question.update', $question)}}" method="post">
            {{csrf_field()}}

            <div class="form-group">
                <label for="question">Question</label>
                <textarea class="form-control" id="question" rows="4" name="question">{{$question->question}}</textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="4" name="description">{{$question->description}}</textarea>
                <small class="form-text text-muted">Short description about the question.</small>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true" name="required" checked id="required">
                <label for="required">Required</label>

            </div>

            <button type="submit" class="btn btn-primary btn-lg" value="Save">Save</button>
        </form>

@endsection