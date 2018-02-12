@if($user->roleCan('access-subreddit'))
    <div class="row">
        <div class="col-md-10">

            <div class="card mb-3">
                <div class="card-header">
                    Reddit Account
                </div>
                <div class="card-body">

                    @if(!$user->redditAccount)

                        <a href="{{route('services.reddit.redirect')}}">Add reddit account</a>
                    @else

                        <div class="row">
                            <div class="col-md-9">{{$user->redditAccount->nickname}}</div>

                            <div class="col-md-1">
                                <a href="{{route('services.reddit.destroy', $user)}}" class="btn btn-sm btn-danger">unlink</a>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
@endif