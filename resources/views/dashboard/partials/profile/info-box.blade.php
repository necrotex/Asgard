<div class="col-2">
    <div class="card">
        <div class="card-header">
            Discord Roles
        </div>

        <div class="card-body">
            @foreach($user->getAssociatedDiscordRoles() as $role)
                <span class="badge badge-primary">{{$role->name}}</span>
            @endforeach
        </div>
    </div>
</div>

<div class="col-2">
    <div class="card">
        <div class="card-header">
            Inerited Roles
        </div>

        <div class="card-body">
            @foreach($user->getAssociatedRoles() as $role)
                <span class="badge badge-primary">{{$role->title}}</span>
            @endforeach

        </div>
    </div>
</div>