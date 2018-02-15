@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: ' . $character->name)
@section('CONTENT_TITLE', $character->name)

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('profile.show', $character->user->id)}}">
                    {{$character->user->mainCharacter->name}}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{$character->name}}
            </li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-3">
            <div class="card">
                <div class="profile-image">
                    <img src="https://image.eveonline.com/Character/{{$character->id}}_512.jpg" class="card-img-top">
                    <div class="profile-overlay text-center">
                        @if($character->status->online)
                            <span class="profile-overlay-text text-success">ONLINE</span>
                        @else
                            <span class="profile-overlay-text text-danger">OFFLINE</span>
                        @endif
                    </div>
                </div>


                <div class="card-body text-center">

                    <h4 class="card-title">{{$character->name}}</h4>
                    <p class="card-text">{{$character->corporation->name}}</p>

                    <p>

                    </p>

                    <p class="card-text text-muted">
                        {{$character->location->solarSystem->solarSystemName}}
                        <br>
                        {{$character->location->shipType->typeName}} ({{$character->location->ship_name}})
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="https://zkillboard.com/character/{{$character->id}}/" title="zKillboard"
                    >
                        <i class="asgard-icon asgard-icon-zkill"></i>
                    </a>
                    <a href="https://evewho.com/pilot/{{str_replace(' ', '+', $character->name)}}" title="EveWho">
                        <i class="asgard-icon asgard-icon-evewho"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-9">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="tab-overview" data-toggle="tab" href="#overview" role="tab"
                       aria-controls="overview" aria-selected="true">
                        Overview
                    </a>

                    <a class="nav-item nav-link" id="tab-history" data-toggle="tab" href="#history" role="tab"
                       aria-controls="profile" aria-selected="false">
                        Corporation History
                    </a>

                    <a class="nav-item nav-link" id="tab-contacts" data-toggle="tab" href="#contacts" role="tab"
                       aria-controls="contacts" aria-selected="false">
                        Contacts
                    </a>

                    <a class="nav-item nav-link" id="tab-history" data-toggle="tab" href="#history" role="tab"
                       aria-controls="profile" aria-selected="false">
                        Transactions
                    </a>

                    <a class="nav-item nav-link" id="tab-history" data-toggle="tab" href="#history" role="tab"
                       aria-controls="profile" aria-selected="false">
                        Mail
                    </a>

                    <a class="nav-item nav-link" id="tab-history" data-toggle="tab" href="#history" role="tab"
                       aria-controls="profile" aria-selected="false">
                        Assets
                    </a>

                    <a class="nav-item nav-link" id="tab-skills" data-toggle="tab" href="#skills" role="tab"
                       aria-controls="skills" aria-selected="false">
                        Skills
                    </a>

                    <a class="nav-item nav-link" id="tab-history" data-toggle="tab" href="#history" role="tab"
                       aria-controls="profile" aria-selected="false">
                        Bookmarks
                    </a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    @include('dashboard.partials.character.overview')
                </div>

                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history">
                    @include('dashboard.partials.character.history')
                </div>

                <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts">
                    @include('dashboard.partials.character.contacts')
                </div>

                <div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="skills">
                    @include('dashboard.partials.character.skills')
                </div>

            </div>
        </div>
    </div>

@endsection