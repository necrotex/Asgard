@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ROLES')
@section('CONTENT_TITLE', 'Roles')

@section('content')
    <div class="row">

        <div class="col-md-12">

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
    </div>

    @include('dashboard.partials.roles.new-role-modal')
@endsection

@section('button-bar')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#createNewRoleModal">New Role</button>
        </div>
    </div>
@endsection