<div class="row">
    <div class="col-md-10">

        <div class="card">
            <div class="card-header">
                <h5>Roles</h5>
            </div>
            <div class="card-body">
                @foreach($user->getAssociatedRoles() as $role)
                    <span class="badge @if(in_array($role->id, $userRoles)) badge-primary @else badge-secondary @endif">{{$role->title}}</span>
                @endforeach
            </div>

            @can('update-roles')
                <div class="card-body">

                    <form method="post" action="{{route('profile.update', $user->id)}}">

                        {{csrf_field()}}

                        <select name="roles[]" id="roles" multiple="multiple" class="w-100">
                            @foreach($roles as $role)
                                <option value="{{$role->name}}" class="form-control"
                                        @if(in_array($role->id, $userRoles)) selected @endif>
                                    {{$role->title}}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" name="roleSubmit" class="btn btn-primary btn-block">Save</button>
                    </form>

                </div>
            @endcan
        </div>
    </div>

</div>
</div>

@push('js')
    <script>
        $('#roles').select2();
    </script>
@endpush