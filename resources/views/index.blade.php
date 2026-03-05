@extends('coreui::layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-house"></i> Welcome, {{ Auth::user()->name }}!
      </div>
      <div class="card-body">
        <p>
          This is your user dashboard. Here you can manage your profile, view notifications, and access other features.
        </p>
        <p>
          Modules can add widgets here using the <code>@stack('user-widgets')</code> directive.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Stack untuk widget dari modul lain -->
@stack('user-widgets')
@endsection