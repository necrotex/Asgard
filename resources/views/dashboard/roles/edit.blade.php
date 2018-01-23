@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: ROLES')
@section('CONTENT_TITLE', 'Roles - Edit ' . $role->title)

@section('content')
    <div class="row">


            <div class="col-md-10">
                <form>
                Name
                <input type="text" value="{{$role->title}}" name="title">
            </div>

            <div class="col-md-2">

                <div class="card">
                    <div class="card-header">
                        <h5>Assign Discord Role</h5>
                    </div>
                    <div class="card-body">

                        <select name="discordRole" id="discord-role">
                            @foreach($discordRoles as $discordRole)
                                <option value="{{$discordRole->id}}" class="form-control">
                                    {{$discordRole->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    </form>

                </div>

            </div>

    </div>

@endsection

@push('js')
    <script>
        $('#discord-role').select2();
    </script>
@endpush