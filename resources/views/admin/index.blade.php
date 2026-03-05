@extends('coreui::layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-house"></i> Welcome, {{ Auth::user()->name }}!
      </div>
      <div class="card-body">
        <p>
          This is your admin dashboard.
        </p>
      </div>
    </div>
  </div>
</div>

@endsection