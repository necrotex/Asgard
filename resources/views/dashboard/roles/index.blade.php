@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: ROLES')
@section('CONTENT_TITLE', 'Roles')

@section('content')
    <div class="row">

        <div class="col-md-10">

            <div class="card">
                <div class="card-body">

                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Last Change</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->title}}</td>
                                <td>{{$role->updated_at}}</td>
                                <td><a href="{{route('roles.edit', $role->id)}}" class="btn btn-sm btn-warning">edit</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createNewRoleModal">
                New Role
            </button>

        </div>
    </div>

    @include('dashboard.partials.roles.new-role-modal')
@endsection
