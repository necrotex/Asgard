@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: ' . 'Timerboard')
@section('CONTENT_TITLE', 'Timerboard')
@section('content')
    @php
        $user = Auth::user();
    @endphp
    <div class="row">

        <div class="col-md-12">

            <div class="card">
                <div class="card-body">

                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th class="w-25">Title</th>
                            <th></th>
                            <th>Created by</th>
                            <th>Limited to</th>
                            <th>Target</th>
                            <th>Countdown</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="TimerStaticTable">

                        @foreach($timers as $timer)
                            @php
                                $forGroup = $timer->forGroup();
                                $ownerName = $timer->owner()->mainCharacter()->first()->name;
                            @endphp
                            <tr>
                                <td class="align-middle">
                                    <span>{{$timer->title}}</span>
                                </td>
                                <td class="align-middle">
                                    <i class="btn fas fa-link icon-vertical-align copyhash pull-right" data-content="Link Copied" data-clipboard-text="{{url("/") . "/timerboard/timer/" . Hashids::encode($timer->id)}}"></i>
                                </td>
                                <td class="align-middle">{{$ownerName}}</td>
                                <td class="align-middle">{{$forGroup == null ? "" : ucfirst($forGroup->name)}} {{$timer->private == true ? "Private" : ""}}</td>
                                <td class="align-middle">{{$timer->target}}</td>
                                <td class="align-middle"><countdown date="{{$timer->target}}"></countdown></td>

                                @if ($user->can('timer-override') || $timer->owner()->id == $user->id)
                                    <td class="align-middle"><button type="button" class="btn btn-sm btn-warning" data-timer="{{$timer}}" data-toggle="modal" data-target="#editTimerModal">Edit</button></td>
                                    <td class="align-middle"><button type="button" class="btn btn-sm btn-danger" data-timer="{{$timer}}" data-owner="{{$ownerName}}" data-toggle="modal" data-target="#deleteTimerModal">Delete</button></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @include('timerboard.partials.new-timer-modal')
    @include('timerboard.partials.delete-timer-modal')
    @include('timerboard.partials.edit-timer-modal')

@endsection

@section('button-bar')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#createNewTimerModal">New Timer</button>
        </div>
    </div>
@endsection

@push('js')
    <script>

        const app = new Vue({
            el: '#TimerStaticTable'
        });

        // For adding new Timer
        $('#select-tab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show')
        });


        new flatpickr(".flatpickr", {
            enableTime: true,
            enableSeconds: true,
            inline: true,
            clickOpens: false,
            time_24hr: true,
            minDate: 'today',
            defaultDate: moment().utc().format(),
            utc: true,
            shorthandCurrentMonth: true,
        });

        // listener for copy link
        cb = new clipboard('.copyhash');

        cb.on('success', function(e) {

            // show notification to user that link is copied
            $(e.trigger).popover("show");
            // hide notification after 1,5s
            setTimeout(
                function() {
                    $(e.trigger).popover("hide");
                }, 1500);
        });

        // Populate modal with correct data
        $('#deleteTimerModal').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            let button = $(event.relatedTarget);

            // Extract info from data-* attributes
            let timer = button.data('timer');
            let owner = button.data('owner');

            let deleteInfo = "'" + timer.title + "'" + "made by '" + owner + "'";

            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this);
            modal.find('.modal-body input').val(deleteInfo);

            // get delete button and the path, for override of correct ID
            let deleteBtn = modal.find('.modal-footer #deleteBtn');
            let deletePath = deleteBtn.attr('href');

            // replace last digits with the new id
            deletePath = deletePath.replace(/(\d)$/,timer.id);

            // set new path
            deleteBtn.attr('href', deletePath);
        });

        $('#editTimerModal').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            let button = $(event.relatedTarget);

            // Extract info from data-* attributes
            let timer = button.data('timer');

            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            let modal = $(this);

            // get delete button and the path, for override of correct ID
            modal.find('.modal-body form').attr('action', function() {

                let path = $(this).attr('action');

                path = path.replace(/(\d)$/,timer.id);

                return path;
            });

            //set current data
            modal.find('.modal-body form').each(function() {
                const fp = document.querySelector(".editTime")._flatpickr;
                fp.setDate(timer.target, true);

                $(this).find('.editTitle').val(timer.title);
                $(this).find('.editGroup').val(timer.forGroup);
                $(this).find('.editPrivate').prop('checked', timer.private)
            });
        });
    </script>
@endpush
