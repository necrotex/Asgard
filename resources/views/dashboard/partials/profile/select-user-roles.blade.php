<div class="row">
    <div class="col-md-10">

        <div class="card">
            <div class="card-header">
                <h5>Roles</h5>
            </div>
            <div class="card-body">

                <form method="post" action="{{route('profile.update', $user->id)}}">

                    {{csrf_field()}}

                    <select name="discordRoles[]" id="discord-role" multiple="multiple" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" class="form-control"
                                    @if(in_array($role->id, $userRoles)) selected @endif>
                                {{$role->title}}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" name="discordRoleSubmit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@push('js')
    <script>
        $('#discord-role').select2();
    </script>
@endpush