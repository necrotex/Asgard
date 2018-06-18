@extends('layouts.dashboard')

@section('PAGE_TITLE', 'Applications')
@section('CONTENT_TITLE', 'Applications')

@section('button-bar')
   <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
         <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#inviteModal">Create Invite</button>
      </div>
   </div>
@endsection

@section('content')
   <div class="row">
      <div class="col-md-12">

         <ul class="nav nav-tabs" id="applicationsTab" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="archive-tab" data-toggle="tab" href="#archive" role="tab" aria-controls="archive" aria-selected="false">Archive</a>
            </li>

         </ul>

      <div class="tab-content" id="applicationsTabContent">
         <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">Active</div>
         <div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">Archive</div>
      </div>

   </div>

   @include('dashboard.partials.application.invite-modal')
@endsection

