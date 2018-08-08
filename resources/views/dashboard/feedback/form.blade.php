@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Feedback')
@section('CONTENT_TITLE', 'Feedback')

@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="alert alert-info">
                <h4>Hi there,</h4>
                <p>your feedback is important to us! If you have ideas, critic or a heavy heart please use this form
                    to talk to leadership anonymously (like really, I don't save the user id). <strong>Please don't misuse this
                    or I'll have to remove it again.</strong></p>
                <hr>
                <p>If you have a personal matter or problem that that you don't want all of
                    leadership to know talk directly to a director you trust.</p>
            </div>

            <form method="post" action="{{route('feedback.store')}}">
                <div class="form-group">
                    <label for="feedback">Feedback</label>
                    <textarea class="form-control" id="feedback" name="feedback" rows="4"></textarea>
                </div>

                {{csrf_field()}}
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
        </div>


    </div>

@endsection