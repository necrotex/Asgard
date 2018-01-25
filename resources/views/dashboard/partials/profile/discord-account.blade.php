<div class="row">
    <div class="col-md-10">

        <div class="card">
            <div class="card-header">
                Discord Account
            </div>
            <div class="card-body">

                @if(!$user->discordAccount)

                    <a href="{{route('services.discord.redirect')}}">Add discord account</a>
                @else

                    <div class="row">
                        <div class="col-md-2">
                            <img class="media-object avatar"
                                 src="{{$user->discordAccount->avatar_url}}"/>
                        </div>

                        <div class="col-md-5">{{$user->discordAccount->nickname}}</div>

                        <div class="col-md-1">
                            <a href="{{route('services.discord.unlink', $user)}}" class="btn btn-sm btn-danger">unlink</a>
                        </div>

                    </div>

                @endif

            </div>

            @if($user->discordAccount)
                <div class="card-footer">
                    Discord Roles:
                    @foreach($user->getAssociatedDiscordRoles() as $role)
                        <span class="badge badge-secondary" style="background-color: #{{dechex($role->color)}} !important;">{{$role->name}}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>