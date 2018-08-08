@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Feedback')
@section('CONTENT_TITLE', 'Feedback')

@section('content')

    <div class="row">

        <div class="col-md-12">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Teaser</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedback as $item)
                        <tr>
                            <th scope="row"><a href="{{route('feedback.show', $item)}}">{{$item->id}}</a></th>
                            <td>{{ str_limit($item->text, 60)}}</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{$feedback->links()}}

        </div>
    </div>

@endsection