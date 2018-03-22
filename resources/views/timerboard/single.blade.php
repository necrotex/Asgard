@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: ' . 'Timerboard')
@section('CONTENT_TITLE', 'Timerboard')
@section('content')

    <div class="row">

        <div class="col-md-10">

            <div class="card">
                <div class="card-body">

                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created by</th>
                            <th>Limited to</th>
                            <th>Target</th>
                            <th>Countdown</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="TimerStaticTable">
                            <tr>
                                <td class="align-middle">
                                    <span>{{$timer->title}}</span>
                                    <i class="btn fas fa-link icon-vertical-align copyhash pull-right" data-id="{{$timer->id}}"></i>
                                </td>
                                <td class="align-middle">{{$timer->owner()->mainCharacter()->first()->name}}</td>
                                <td class="align-middle">{{$timer->forGroup() == null ? "" : $timer->forGroup()->name}}</td>
                                <td class="align-middle">{{$timer->target}}</td>
                                <td class="align-middle"><countdown date="{{$timer->target}}"></countdown></td>
                                {{--todo if owner or admin/director, then edit is allowed/shown --}}
                                <td class="align-middle"><a href="{{route('timerboard.edit', $timer->id)}}" class="btn btn-sm btn-warning">edit</a></td>
                                <td class="align-middle"><a href="{{route('timerboard.delete', $timer->id)}}" class="btn btn-sm btn-danger">delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
           // listener for copy link
            $('#TimerStaticTable').on('click', '.copyhash', function() {
                //Ajax call to get url then paste to clipboard
                $.ajax({
                    method: 'GET', // Type of response and matches what we said in the route
                    url: '/timerboard/timer/' + $(this).data('id') + '/getlink',
                    success: function(response){ // What to do if we succeed
                        console.log(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            });
        </script>
    @endpush

@endsection