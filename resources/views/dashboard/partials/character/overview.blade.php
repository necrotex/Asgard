
    <div class="row mt-3">

        <div class="col-5">

            <div class="card">
                <div class="card-header">
                    Skillqueue <span class="small text-muted pull-right">Ends {{$character->skillqueue->last()->finish_date}}</span>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">

                    @foreach($character->skillqueue as $skill)
                        @php
                            $start = $skill->level_start_sp;
                            $end = $skill->level_end_sp;

                            if($loop->first) {
                                $current = $character->skillpoints->total_sp - ($character->skillpoints->total_sp - $skill->level_start_sp);
                            } else {
                                $current = $skill->training_start_sp - $skill->level_start_sp;
                            }

                            $percent = (100/$end) * $current;

                        @endphp

                        <div class="card mb-2">
                                <div class="card-body">
                                    {{$skill->type->typeName}} {{ $skill->finished_level }}

                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                             style="width: {{$percent}}%"
                                             role="progressbar" aria-valuenow="{{$current}}"
                                             aria-valuemin="{{$start}}" aria-valuemax="{{$end}}"></div>
                                    </div>
                                    <span class="small text-muted">Ends in {{$skill->finish_date->diffForHumans()}}</span>
                                </div>
                        </div>

                    @endforeach
                    </ul>

                </div>
            </div>

        </div>
    </div>
