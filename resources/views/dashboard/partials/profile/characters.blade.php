
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Characters
            </div>
            <div class="card-body">

                @foreach($user->characters as $character)
                    <div class="card character-card mb-2">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-1">
                                    <img class="media-object avatar"
                                         src="https://image.eveonline.com/Character/{{$character->id}}_64.jpg"/>
                                </div>

                                <div class="col-md-10">
                                    {{$character->name}}
                                    <br/>
                                    {{$character->owner_hash}}

                                </div>

                                <div class="col-md-1 status-col">
                                    <div class="status status-success pull-right">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>