<h5>Characters</h5>

@foreach($user->characters as $character)
    <div class="card mb-1">
        <div class="card-body">
            <div class="row">
                <div class="col-2 text-center">
                    <img src="https://image.eveonline.com/Character/{{$character->id}}_128.jpg" width="50"
                         alt="{{$character->name}}"
                         class="mx-auto rounded-circle img-fluid">
                </div>
                <div class="col-10">
                    <h5 class="card-title"><a href="{{route('characters.show', $character->id)}}">
                            {{$character->name}}
                        </a></h5>

                    <h6 class="card-subtitle mb-2 text-muted">{{optional($character->corporation)->name}}</h6>
                </div>
            </div>
        </div>
    </div>
@endforeach
