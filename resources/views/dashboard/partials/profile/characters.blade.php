<h3>Characters</h3>

@foreach($user->characters as $character)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-8 col-md-6">
                    <h3 class="mb-0 text-truncated">
                        <a href="{{route('characters.show', $character->id)}}">
                            {{$character->name}}
                        </a>
                    </h3>
                    <p class="lead">{{optional($character->corporation)->name}}</p>

                </div>
                <div class="col-12 col-lg-4 col-md-6 text-center">
                    <img src="https://image.eveonline.com/Character/{{$character->id}}_128.jpg" width="100" alt="{{$character->name}}"
                         class="mx-auto rounded-circle img-fluid">
                </div>
            </div>
            <!--/row-->
        </div>
    </div>
@endforeach
