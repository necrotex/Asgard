@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: Roles')
@section('CONTENT_TITLE', 'Roles')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Role</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr class="table-primary">
                    <td>Row</td>
                    <td>@hackerthemes</td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>


@endsection
