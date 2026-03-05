<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name'))</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  @include('users::partials.styles-auth')
  @stack('styles')
</head>
<body class="{{ session('is_telegram_app') ? 'telegram-app' : '' }}">
  <div class="col-md-6 col-lg-5">
    @if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm mb-3">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li><small>{{ $error }}</small></li>
        @endforeach
      </ul>
    </div>
    @endif
  </div>
  <div class="col-md-6 col-lg-5">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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