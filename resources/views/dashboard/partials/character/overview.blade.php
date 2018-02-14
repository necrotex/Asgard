
    <div class="row mt-3">
        <div class="col-5">

            <div class="card">
                <div class="card-header">
                    Skillqueue
                </div>

                <div class="card-body">

                    @foreach($character->skillqueue as $skill)
                        <div class="card mb-2">
                            <div class="card-body">
                                <span class="card-title"></span>
                                {{$skill->type->typeName}} {{ $skill->finished_level }}

                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar" aria-valuenow="{{$character->skillpoints->total_sp}}"
                                         aria-valuemin="{{$character->skillpoints->total_sp - $skill->level_start_sp}}" aria-valuemax="{{$skill->level_end_sp + $character->skillpoints->total_sp}}"></div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        </div>
    </div>
