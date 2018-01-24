@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: ROLES')
@section('CONTENT_TITLE', 'Roles - Edit ' . $role->title)

@section('content')
    <form method="post" action="{{route('roles.update', $role)}}">
        <div class="row">
            {{csrf_field()}}

            <div class="col-md-10">

                Name
                <input type="text" value="{{$role->title}}" name="title">
            </div>

            <div class="col-md-2">

                <div class="card">
                    <div class="card-header">
                        <h5>Assign Discord Role</h5>
                    </div>
                    <div class="card-body">

                        <select name="discordRoles[]" id="discord-role" multiple="multiple">
                            @foreach($discordRoles as $discordRole)
                                <option value="{{$discordRole->id}}" class="form-control"
                                @if(in_array($discordRole->id, $roleDiscordRoles)) selected @endif>
                                    {{$discordRole->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>


                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <button type="submit">Save</button>
            </div>
        </div>
    </form>

@endsection

@push('js')
    <script>
        $('#discord-role').select2();
    </script>
@endpush