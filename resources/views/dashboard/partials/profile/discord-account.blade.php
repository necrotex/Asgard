<div class="row">
    <div class="col-md-12">

        <div class="card mb-3">
            <div class="card-header">
                Discord Account
            </div>
            <div class="card-body">

                @if(!$user->discordAccount && auth()->user()->id == $user->id)

                    <a href="{{route('services.discord.redirect')}}">Add discord account</a>
                @else

                    <div class="row">
                        <div class="col-md-2">
                            <img class="media-object avatar"
                                 src="{{$user->discordAccount->avatar_url ?? 'http://via.placeholder.com/50'}}"/>
                        </div>

                        <div class="col-md-5">{{$user->discordAccount->nickname ?? 'N/A'}}</div>

                        @if(auth()->user()->id == $user->id)
                            <div class="col-md-1">
                                <a href="{{route('services.discord.unlink', $user)}}"
                                   class="btn btn-sm btn-danger">unlink</a>
                            </div>
                        @endif

                    </div>

                @endif

            </div>

            @if($user->discordAccount)
                <div class="card-footer">
                    Discord Roles:
                    @foreach($user->getDiscordRoles() as $role)
                        <span class="badge badge-secondary"
                              style="background-color: #{{dechex($role->color)}} !important;">{{$role->name}}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>