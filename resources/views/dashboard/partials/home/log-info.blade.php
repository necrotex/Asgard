<li class="list-group-item list-group-item list-group-item-info">

    <b>Info</b>: {{$message->description}}:
    @if(is_a($message->subject, \Asgard\Models\User::class) && $message->subject->mainCharacter)
        <b><a href="{{route('characters.show', $message->subject)}}">{{$message->subject->mainCharacter->name}}</a> </b>
    @else
        <b><a href="{{route('profile.show', $message->subject)}}">{{$message->subject->name}}</a> </b>
    @endif

    <br>

    <small class="text-muted">{{$message->created_at}}</small>
</li>