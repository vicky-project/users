@extends('coreui::layouts.mini-app')
@section('title', 'Dashboard')
@section('content')
<div class="app-logo d-flex justify-content-center align-items-center text-center p-4">
  <i class="bi bi-app rounded-circle"></i>
</div>

<div class="app-name h4 fw-bold text-center">
  Application
</div>

<div class="app-description text-center pb-4">
  <small>
    Daftar aplikasi yang tersedia.
  </small>
</div>

<div class="container text-center mt-4 p-3">
  <div class="row">
    @hook('user-apps')
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
  const initData = window.Telegram?.WebApp?.initData || @json(request()->get("initData", ""));
  if(!initData) return;

  const menus = document.querySelectorAll('.app-item');
  menus.forEach(function(menu) {
  const urlObj = new URL(menu.href, window.location.origin);
  urlObj.searchParams.set("initData", initData);
  menu.href = urlObj.toString();
  });
  });
</script>
@endpush