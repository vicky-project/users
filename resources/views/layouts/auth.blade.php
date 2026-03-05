<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name'))</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  {{-- Google Fonts (opsional) --}}
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap" rel="stylesheet">

  {{-- Gaya kustom auth --}}
  @include('users::partials.styles-auth')
  @stack('styles')
</head>
<body class="d-flex align-items-center py-4 bg-light {{ session('is_telegram_app') ? 'telegram-app' : '' }}">

  {{-- Container dengan tinggi penuh viewport --}}
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">

        {{-- Tampilkan error jika ada --}}
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <strong>Oops!</strong> Ada beberapa masalah dengan input Anda.
          <ul class="mt-2 mb-0 ps-3">
            @foreach ($errors->all() as $error)
            <li><small>{{ $error }}</small></li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Konten halaman (login, register, dll) --}}
        @yield('content')
      </div>
    </div>
  </div>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Script Telegram --}}
  <script>
    if (window.Telegram?.WebApp) {
      Telegram.WebApp.ready();
      Telegram.WebApp.expand();
      document.body.classList.add('telegram-app');
    }
  </script>
  @stack('scripts')
</body>
</html>