@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: Corporations')
@section('CONTENT_TITLE', 'Corporations')

@section('content')
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            @foreach($corporations as $corporation)
                <div class="card">
                    <div class="card-header" role="tab" id="heading-{{$corporation->id}}">
                        <h5>
                            <a href="{{route('corporation.show', $corporation->id)}}">
                                [{{$corporation->ticker}}] {{$corporation->name}}
                            </a>
                        </h5>

                    </div>
                </div>
            @endforeach
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