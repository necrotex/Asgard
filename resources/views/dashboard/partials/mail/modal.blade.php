<div class="modal-header">
    <dl class="row small text-muted">
        <dt class="col-sm-3">Recipents:</dt>
        <dd class="col-sm-9" id="mail-modal-recipents">
            @foreach($mail->recipients as $recipient)
                @switch($recipient->type)
                    @case('character')
                        <a href="https://evewho.com/pilot/{{str_replace(' ', '+', $recipient->recipient_name)}}">
                            {{$recipient->recipient_name}}
                        </a>
                    @break

                    @case('corporation')
                        <a href="https://evewho.com/corp/{{str_replace(' ', '+', $recipient->recipient_name)}}">
                            {{$recipient->recipient_name}}
                        </a>
                    @break

                    @case('alliance')
                        <a href="https://evewho.com/alli/{{str_replace(' ', '+', $recipient->recipient_name)}}">
                            {{$recipient->recipient_name}}
                        </a>
                    @break
                @endswitch

                @if(!$loop->last)
                    ,&bsp;
                @endif
            @endforeach
        </dd>

        <dt class="col-sm-3">Sender</dt>
        <dd class="col-sm-9" id="mail-modal-sender">
            @switch($mail->sender_type)
                @case('character')
                <a href="https://evewho.com/pilot/{{str_replace(' ', '+', $mail->sender_name)}}">
                    {{$mail->sender_name}}
                </a>
                @break

                @case('corporation')
                <a href="https://evewho.com/corp/{{str_replace(' ', '+', $mail->sender_name)}}">
                    {{$mail->sender_name}}
                </a>
                @break

                @case('alliance')
                <a href="https://evewho.com/alli/{{str_replace(' ', '+', $mail->sender_name)}}">
                    {{$mail->sender_name}}
                </a>
                @break

                @default
                    n/a (Couldn't resolve ID)
                @break
            @endswitch
        </dd>

        <dt class="col-sm-3">Date</dt>
        <dd class="col-sm-9" id="mail-modal-date">
            {{$mail->date}}
        </dd>
    </dl>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <h5 class="modal-title clearfix" id="mail-modal-subject"> {!!$mail->subject !!}</h5>

    @foreach(explode("\n", $mail->content) as $paragraph)
        <p id="mail-modal-content">{!! $paragraph !!}</p>
    @endforeach

</div>