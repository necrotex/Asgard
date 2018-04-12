@extends('layouts.dashboard')

@section('PAGE_TITLE', 'CORPORATION')
@section('CONTENT_TITLE', 'Corporation - ' . $corporation->ticker)

@section('content')
    <form method="post" action="{{route('corporation.update', $corporation->id)}}">
        {{csrf_field()}}

        <div class="row">
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-body">

                        <dl class="row">

                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-3">{{$corporation->name}}</dd>

                            <dt class="col-sm-3">ID</dt>
                            <dd class="col-sm-3">{{$corporation->id}}</dd>

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


        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        Default Member role
                    </div>
                    <div class="card-body">

                        <select multiple="multiple" class="w-100" id="member-role" name="defaultRoles[]">
                            @foreach($roles as $role)
                                <option value="{{$role->name}}" @if(in_array($role->id, $defaultRoles)) selected @endif>
                                    {{$role->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

@push('js')
    <script>
        $('#member-role').select2();
    </script>

@endpush