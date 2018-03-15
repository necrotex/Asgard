@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: Application Forms')
@section('CONTENT_TITLE', 'Application Forms')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Corporation</th>
                    <th scope="col">Last Change</th>
                    <th scope="col">Active</th>
                </tr>
                </thead>
                <tbody>

                @foreach($forms as $form)
                    <tr>
                        <td>
                            <a href="{{route('forms.show', $form)}}">
                                {{$form->name}}
                            </a>
                        </td>
                        <td>{{$form->corporation->name}}</td>
                        <td>{{$form->updated_at}}</td>
                        <td>{{$form->active}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    Create new Form
                </div>
                <div class="card-body">
                    <div class="">Create a new Application form</div>

                    <a href="{{route('forms.create')}}" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">New Form</a>
                </div>
            </div>

        </div>
    </div>
@endsection