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

                <div class="card" style="w-100">
                    <ul class="list-group list-group-flush" id="sortable">
                        <li class="list-group-item" id="1">
                            <i class="fas fa-sort"></i>
                            Cras justo odio
                        </li>
                        <li class="list-group-item" id="2">
                            <i class="fas fa-sort"></i>Dapibus ac facilisis in</li>
                        <li class="list-group-item" id="3"><i class="fas fa-sort"></i>Vestibulum at eros</li>
                    </ul>
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

        <input type="hidden" id="sorted">

        {{csrf_field()}}
    </form>
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