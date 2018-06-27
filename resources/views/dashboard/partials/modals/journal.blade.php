<div class="modal-header">
    <h5 class="modal-title clearfix" id="mail-modal-subject">Journal Ref ID: {{$entry->ref_id}}</h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <dl class="row">
        <dt class="col-sm-3">Date</dt>
        <dd class="col-sm-9">{{$entry->date}}</dd>

    </dl>
    <dl class="row">
        <dt class="col-sm-3">Type</dt>
        <dd class="col-sm-9">{{$entry->ref_type}}</dd>
    </dl>

    </dl>
    <dl class="row">
        <dt class="col-sm-3">Amount</dt>
        <dd class="col-sm-9">{{$entry->amount}} ISK</dd>
    </dl>

    </dl>
    <dl class="row">
        <dt class="col-sm-3">Balance</dt>
        <dd class="col-sm-9">{{$entry->balance}} ISK</dd>
    </dl>

    @if($entry->tax)
        <dl class="row">
            <dt class="col-sm-3">Tax</dt>
            <dd class="col-sm-9">{{$entry->tax}} ISK</dd>
        </dl>
    @endif


    @if($entry->first_party_name)
        <dl class="row">
            <dt class="col-sm-3">First Party</dt>

            <dd class="col-sm-9"><a href="https://evewho.com/pilot/{{str_replace(' ', '+', $entry->first_party_name)}}"
                                    title="EveWho">
                    {{$entry->first_party_name}}
                </a></dd>
        </dl>
    @endif

    @if($entry->second_party_name)
        <dl class="row">
            <dt class="col-sm-3">Second Party</dt>
            <dd class="col-sm-9"><a href="https://evewho.com/pilot/{{str_replace(' ', '+', $entry->second_party_name)}}"
                                    title="EveWho">
                    {{$entry->second_party_name}}
                </a></dd>
        </dl>
    @endif

    <dl class="row">
        <dt class="col-sm-3">Description</dt>
        <dd class="col-sm-9">{{$entry->description}}</dd>
    </dl>

    @if($entry->reason)
        <dl class="row">
            <dt class="col-sm-3">Reason</dt>
            <dd class="col-sm-9">{{$entry->reason}}</dd>
        </dl>
    @endif


</div>