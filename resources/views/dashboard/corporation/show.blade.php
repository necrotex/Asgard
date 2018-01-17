@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: CORPORATION')
@section('CONTENT_TITLE', 'Corporation - ' . $corporation->ticker)

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">

                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-3">{{$corporation->id}}</dd>

                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-3">{{$corporation->name}}</dd>

                        <dt class="col-sm-3">Member Count</dt>
                        <dd class="col-sm-3">{{$corporation->member_count}}</dd>

                        <dt class="col-sm-3">Tax Rate</dt>
                        <dd class="col-sm-3">{{$corporation->tax_rate}}%</dd>
                    </dl>

                </div>
            </div>

        </div>

        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </div>

    </div>

    <br >

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Default Member role</h4>
                        <select class="form-control" id="member-role">
                            <option>Member</option>
                        </select>
                </div>
            </div>
        </div>

        <div class="col-md-4 offset-1">
            <div class="card">
                <div class="card-body">
                    <h4>Default Discord Role</h4>
                        <select class="form-control" id="discord-role">
                            @foreach($discordRoles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
        <script>
        $('#member-role').select2();
        $('#discord-role').select2();
    </script>

@endpush