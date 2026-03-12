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
      </div>
    </div>
  </div>
</div>

<div class="container text-center mt-4 p-3">
  <div class="row">
    @hook('dashboard-apps')
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
  const initData = window.Telegram?.WebApp?.initData || @json(request()->get("initData", ""));
  if(!initData) return;

  const token = localStorage.getItem("telegram_token") || '{{ request()->get("token") }}';
  if(!token) return;

  const apps = document.querySelectorAll(".app-item");
  apps.forEach(function(app) {
  const urlObj = new URL(app.href, window.location.origin);
  urlObj.searchParams.set("token", token);
  urlObj.searchParams.set("initData", initData);
  app.href = urlObj.toString();
  app.setAttribute("disabled", false);
  });
  });
</script>
@endpush