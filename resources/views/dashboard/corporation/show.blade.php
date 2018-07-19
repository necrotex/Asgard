@extends('layouts.dashboard')

@section('PAGE_TITLE', 'CORPORATION')
@section('CONTENT_TITLE', 'Corporation - ' . $corporation->ticker)

@section('content')
    <div class="col-12">
        <nav class="mb-1">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="tab-overview" data-toggle="tab" href="#overview" role="tab"
                   aria-controls="overview" aria-selected="true">
                    Overview
                </a>

                <a class="nav-item nav-link" id="tab-active-members" data-toggle="tab" href="#active-members" role="tab"
                   aria-controls="active-members" aria-selected="false">
                    Active Members
                </a>

                <a class="nav-item nav-link" id="tab-missing-members" data-toggle="tab" href="#missing-members" role="tab"
                   aria-controls="missing-members" aria-selected="false">
                    Missing Members
                </a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                @include('dashboard.partials.corporation.overview')
            </div>

            <div class="tab-pane fade show" id="active-members" role="tabpanel" aria-labelledby="active-members">
                @include('dashboard.partials.corporation.members', ['table' => 'active-members', 'route' => 'corporation.active-members'])
            </div>

            <div class="tab-pane fade show" id="missing-members" role="tabpanel" aria-labelledby="missing-members">
                @include('dashboard.partials.corporation.members', ['table' => 'missing-members', 'route' => 'corporation.missing-members'])
            </div>
        </div>
    </div>
@endsection

