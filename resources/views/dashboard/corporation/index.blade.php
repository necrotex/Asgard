@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: Corporations')
@section('CONTENT_TITLE', 'Corporations')

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div id="accordion" role="tablist">

            @foreach($corporations as $corporation)

                    <div class="card">
                        <div class="card-header" role="tab" id="heading-{{$corporation->id}}">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapse-{{$corporation->id}}" role="button" aria-expanded="true" aria-controls="collapse-{{$corporation->id}}">
                                    {{$corporation->name}}
                                </a>
                            </h5>
                        </div>

                        <div id="collapse-{{$corporation->id}}" class="collapse show" role="tabpanel" aria-labelledby="heading-{{$corporation->id}}" data-parent="#accordion">
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-3">ID</dt>
                                    <dd class="col-sm-3">{{$corporation->id}}</dd>

                                    <dt class="col-sm-3">Name</dt>
                                    <dd class="col-sm-3">{{$corporation->name}}</dd>

                                    <dt class="col-sm-3">Ticker</dt>
                                    <dd class="col-sm-3">{{$corporation->ticker}}</dd>

                                    <dt class="col-sm-3">Member Count</dt>
                                    <dd class="col-sm-3">{{$corporation->member_count}}</dd>

                                    <dt class="col-sm-3">Tax Rate</dt>
                                    <dd class="col-sm-3">{{$corporation->tax_rate}}%</dd>
                                </dl>

                                <hr>

                                <div class="row">
                                    <div class="col-sm-5">
                                            <select multiple id="role-select" style="width: 100%">
                                                <option>Member</option>
                                                <option>Full Access</option>
                                                <option>Ally</option>
                                            </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit">Save</button>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <small>Last Updated : {{$corporation->updated_at}}</small>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-body">

                    <form action="{{route('corporation.store')}}" method="post">
                        {{csrf_field()}}

                        <input type="text" class="add-corporation" name="corp_id" placeholder="Corporation ID">

                        @if($errors)
                            <span class="help-block">
                                <strong>{{ $errors->first('corp_id') }}</strong>
                            </span>
                        @endif


                        <button type="submit" class="btn btn-primary btn-lg btn-block">Add</button>


                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script>

        $('#role-select').select2({
            width: 'resolve',
            placeholder: 'Access Role'
        });
    </script>

@endpush