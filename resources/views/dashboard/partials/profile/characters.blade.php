<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Characters
        </div>

        <ul class="list-group list-group-flush">
            @foreach($user->characters as $character)
                <a href="{{route('characters.show', $character->id)}}" class="list-group-item">
                    <img class="media-object avatar-profile"
                         src="https://image.eveonline.com/Character/{{$character->id}}_64.jpg"/>
                    <h5 @if(!$character->active) class="text-muted" @endif>{{$character->name}}</h5>
                </a>
            @endforeach
        </ul>

    </div>
</div>