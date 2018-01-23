<div class="row">
    <div class="col-md-10">
        <h5>Discord Account</h5>

        <div class="card">
            <div class="card-body">

                @if(!$user->discordAccount)

                    <a href="{{route('services.discord.redirect')}}">Add discord account</a>
                @else

                    <div class="row">
                        <div class="col-md-1">
                            <img class="media-object avatar"
                                 src="{{$user->discordAccount->avatar_url}}"/>
                        </div>

                        <div class="col-md-10">{{$user->discordAccount->nickname}}</div>

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