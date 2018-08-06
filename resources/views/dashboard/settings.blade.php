@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Settings')
@section('CONTENT_TITLE', 'Settings')

@section('content')
    <form method="post" action="">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-2">
                    <div class="card-header">
                        Subreddit Moderator Account
                    </div>
                    <div class="card-body ">

                        @if(!\Asgard\Models\Setting::get('reddit.modaccount.name'))

                            <a href="{{route('services.reddit.redirect_modaccount')}}">Add reddit account</a>
                        @else

                            <div class="row">
                                <div class="col-md-10">{{\Asgard\Models\Setting::get('reddit.modaccount.name')}}</div>

                                <div class="col-md-1 status-col">
                                    <div class="status status-success pull-right">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </div>
                                </div>

                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Recruitment Notification Channel
                            </div>
                            <div class="card-body">
                                <select id="recruitment-notification-channel" name="recruitment-notification-channel"
                                        class="w-100">
                                    @foreach($discord_channels as $channel)
                                        <option value="{{$channel->id}}"
                                                @if($channel->id == \Asgard\Models\Setting::get('notification.recruitment')) selected @endif>
                                            {{$channel->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{csrf_field()}}
        <button type="submit" class="btn btn-primary mt-2">Save</button>

    </form>
@endsection

@push('js')
    <script>
        $('#recruitment-notification-channel').select2();
    </script>
@endpush