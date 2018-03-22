<div class="modal fade" id="editTimerModal" tabindex="-1" role="dialog" aria-labelledby="editTimer" aria-hidden="true" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Timer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="select">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" id="select-tab"><a class="nav-link" href="#editcountdowntime" aria-controls="editcountdowntime" role="tab" data-toggle="tab">Countdown</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#editdate" id="select-tab" aria-controls="editdate" aria-selected="true"  role="tab" data-toggle="tab">Date</a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane show fade" id="editcountdowntime">
                            <form class="form-horizontal timepicker-form" method="post" action="{{route('timerboard.edit', $timer->id)}}">
                                {{ csrf_field() }}
                                <div class="center-timepicker-group">
                                    <div class="form-group timepicker-group">
                                        <label for="time-days">Days</label>
                                        <input type="number" class="form-control timepicker" name="time-days" placeholder="0" step="1" min="0" required="required">
                                    </div>

                                    <div class="form-group timepicker-group">
                                        <label for="time-hours">Hours</label>
                                        <input type="number" class="form-control timepicker" name="time-hours" placeholder="0" min="0" step="1" max="23" required="required">
                                    </div>

                                    <div class="form-group timepicker-group">
                                        <label for="time-minutes">Min</label>
                                        <input type="number" class="form-control timepicker" name="time-minutes" placeholder="0" min="0" step="1" max="59" required="required">
                                    </div>

                                    <div class="form-group timepicker-group">
                                        <label for="time-seconds">Sec</label>
                                        <input type="number" class="form-control timepicker" name="time-seconds" placeholder="0" min="0" step="1" max="59" required="required">
                                    </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control editTitle" name="title" placeholder="Title of timer" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label for="Group">Limited to:</label>
                                        <select class="custom-select editGroup" name="limitgroup">
                                            <option selected>None</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="custom-control ios-switch">
                                            <span class="ios-switch-control-description">For alliance</span>
                                            <input type="checkbox" name="private" class="ios-switch-control-input editPrivate">
                                            <span class="ios-switch-control-indicator"></span>
                                            <span class="ios-switch-control-description">For my eyes only</span>
                                        </label>
                                </div>

                                <input class="btn btn-primary btn-block submit" type="submit" value="Edit">
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane active show fade" id="editdate">
                            <form method="post" action="{{route('timerboard.edit', $timer->id)}}" novalidate>
                                {{ csrf_field() }}

                                <input class="flatpickr form-control editTime" name="datetime" type="text" required="required">
                                <small class="center-block text-center text-muted" style="margin-top: 10px;">All times in UTC</small>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control editTitle" name="title" placeholder="Title of timer" required="required">
                                </div>

                                <div class="form-group">
                                    <label for="Group">Limited to:</label>
                                    <select class="custom-select editGroup" name="limitgroup">
                                        <option selected>None</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="custom-control ios-switch">
                                        <span class="ios-switch-control-description">For alliance</span>
                                        <input type="checkbox" name="private" class="ios-switch-control-input editPrivate">
                                        <span class="ios-switch-control-indicator"></span>
                                        <span class="ios-switch-control-description">For my eyes only</span>
                                    </label>
                                </div>

                                <input class="btn btn-primary btn-block submit" type="submit" value="Edit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>