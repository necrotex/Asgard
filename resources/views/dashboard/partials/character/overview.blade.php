<div class="row mt-3">
    <div class="col-3">

        <div class="card">
            <div class="card-header">
                Skillpoints
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-6">Total</dt>
                    <dd class="col-sm-6">{{ number_format($character->skillpoints->total_sp,0) }}</dd>

                    <dt class="col-sm-6">Unallocated</dt>
                    <dd class="col-sm-6">{{ number_format($character->skillpoints->unallocated_sp,0) }}</dd>
                </dl>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Wallet
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-5">ISK</dt>
                    <dd class="col-sm-7">{{ number_format($character->wallet->last()->amount, 2) }}</dd>
                </dl>
            </div>
        </div>

    </div>

    <div class="col-5">

        <div class="card">
            <div class="card-header">
                Skillqueue
                @if(!is_null(optional($character->skillqueue->last())->finish_date))
                     <span class="small text-muted pull-right">Ends {{$character->skillqueue->last()->finish_date}}</span>
                @else
                    <span class="small text-muted pull-right">No skill in training</span>
                @endif
            </div>

            <div class="card-body">
                <ul class="list-group list-group">

                    @foreach($character->skillqueue as $skill)
                        @php
                            $start = 0;
                            $end = 0;
                            $current = 0;
                            $percent = 0;

                            if(!is_null($skill->start_date)) {
                                $end = $skill->finish_date->diffInSeconds($skill->start_date);
                                $current = \Carbon\Carbon::now()->diffInSeconds($skill->start_date);
                                $percent = (100/$end) * $current;
                            }

                        @endphp

                        @if($loop->first && !is_null($skill->start_date) && !is_null($skill->finish_date))
                            <div class="card">
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
                        @else
                            <li class="list-group-item">
                                    {{$skill->type->typeName}} {{ $skill->finished_level }}
                            </li>
                        @endif

                    @endforeach
                </ul>

            </div>
        </div>

    </div>
</div>
