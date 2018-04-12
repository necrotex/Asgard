@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Corporations')
@section('CONTENT_TITLE', 'Corporations')

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="card">
                <ul class="list-group list-group-flush">
                    @foreach($corporations as $corporation)
                        <a href="{{route('corporation.show', $corporation->id)}}" class="list-group-item">
                            [{{$corporation->ticker}}] {{$corporation->name}}
                        </a>
                    @endforeach
                </ul>

            </div>
            {{$corporations->links()}}
        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    Add Corporation
                </div>
                <div class="card-body">

                    <form action="{{route('corporation.store')}}" method="post">
                        {{csrf_field()}}

                        <input type="text" class="form-control w-100 mb-3" name="corp_id" placeholder="Corporation ID">

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