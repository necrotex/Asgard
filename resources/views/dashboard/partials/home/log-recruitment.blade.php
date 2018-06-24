<li class="list-group-item list-group-item list-group-item-primary">
    <b>Recruitment</b>: <a
            href="{{route('applications.show', $message->causer)}}">{{$message->description}} {{$message->subject->name}}
        for {{$message->causer->mainCharacter->name}}</a>
    <br>
    <small class="text-muted">{{$message->created_at}}</small>
</li>