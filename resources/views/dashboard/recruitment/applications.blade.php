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
      <div class="col-md-6 col-md-offset-3">

      </div>

   </div>
@endsection

@include('dashboard.partials.application.invite-modal')