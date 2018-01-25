@if($user->roleCan('access-reddit'))
    <div class="row">
        <div class="col-md-10">

            <div class="card">
                <div class="card-header">
                    Reddit Account
                </div>
                <div class="card-body">

                    @if(!$user->redditAccount)

                        <a href="{{route('services.reddit.redirect')}}">Add reddit account</a>
                    @else

                        <div class="row">
                            <div class="col-md-10">{{$user->redditAccount->nickname}}</div>

                            <div class="col-md-1 status-col">
                                <div class="status status-success pull-right">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </div>
                            </div>

                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
@endif