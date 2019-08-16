@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Settings')
@section('CONTENT_TITLE', 'Settings')

@section('content')
    <form method="post" action="">
        <div class="row">
            <div class="col-6">
                <div class="row">

                    <div class="col-12">
                        <div class="card mb-2">
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

        <div class="row">
            <div class="col-6">
                <div class="row">

                    <div class="col-12">
                        <div class="card mb-2">
                            <div class="card-header">
                                Unrestricted Discord Roles
                            </div>
                            <div class="card-body">
                                <select id="unrestricted-discord-roles" name="unrestricted-discord-roles[]"
                                        class="w-100" multiple>
                                    @foreach($discord_roles as $role)
                                        <option value="{{$role->id}}"
                                                @if(!$role->restricted) selected @endif>
                                            {{$role->name}}
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
        $('#unrestricted-discord-roles').select2();
    </script>
@endpush