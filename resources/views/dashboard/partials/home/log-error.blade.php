<li class="list-group-item list-group-item list-group-item-danger">
    <b>Error:</b> {{$message->description}} <b>{{$message->subject->name}}</b>

    <a href="#" class="text-muted" data-toggle="collapse"
       data-target="#collapse-{{$message->id}}" aria-expanded="false"
       aria-controls="collapse-{{$message->id}}">
        <i class="fas fa-info-circle"></i>
    </a>

    <div class="collapse" id="collapse-{{$message->id}}">
        <code>{{$message->getExtraProperty('exception')}}</code>
    </div>

    <br/>

    <small class="text-muted">{{$message->created_at}}</small>
</li>