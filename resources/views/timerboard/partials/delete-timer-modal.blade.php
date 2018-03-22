<div class="modal fade" id="deleteTimerModal" tabindex="-1" role="dialog" aria-labelledby="newTimer" aria-hidden="true" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Timer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <large>Are you sure you want to delete this timer?</large>
                <input type="text" class="disabled form-control" disabled value=""/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" id="deleteBtn" class="btn btn-danger" href="{{route('timerboard.delete', 0000)}}">Delete</a>
            </div>
        </div>
    </div>
</div>