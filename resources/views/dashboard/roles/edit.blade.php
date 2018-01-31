@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: ROLES')
@section('CONTENT_TITLE', 'Roles - Edit ' . $role->title)

@section('content')
    <form method="post" action="{{route('roles.update', $role)}}">
        <div class="row">
            {{csrf_field()}}

            <div class="col-md-8">

                Name
                <input type="text" value="{{$role->title}}" name="title">
            </div>

            <div class="col-md-2">

                <div class="card">
                    <div class="card-header">
                        Assign Discord Role
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

            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">
                        Reddit Access
                    </div>
                    <div class="card-body">
                        <select id="reddit-access" class="form-control" name="redditAccess">
                            <option value="true" @if($role->can('access-reddit')) selected @endif>Yes</option>
                            <option value="false" @if(!$role->can('access-reddit')) selected @endif>No</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.partials.roles.abilities')

        <div class="row">
            <div class="col-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

            <div class="col-3">
                <a href="{{route('roles.destroy', $role)}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </form>

@endsection

@push('js')
    <script>
        $('#discord-role').select2();
        $('#reddit-access').select2({
            minimumResultsForSearch: Infinity
        });
    </script>
@endpush