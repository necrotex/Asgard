
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