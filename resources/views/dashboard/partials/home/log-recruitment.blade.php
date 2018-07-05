<li class="list-group-item list-group-item list-group-item-primary">
    <b>Recruitment</b>: <a
            href="{{route('applications.show', $message->subject)}}">{{$message->description}}</a>
    <br>
    <small class="text-muted">{{$message->created_at}}</small>
</li>