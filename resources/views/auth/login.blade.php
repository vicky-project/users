@extends('users::layouts.auth')
@section('title', 'Masuk ke Akun')
@section('content')
<div class="card">
  <div class="card-header">
    <i class="bi bi-box-arrow-in-right me-2"></i>Login
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('login') }}">
      @csrf

      {{-- Email --}}
      <div class="mb-4 input-icon">
        <i class="bi bi-envelope-fill"></i>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
        <label for="email" class="form-label sr-only">Alamat Email</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      {{-- Password --}}
      <div class="mb-4 input-icon">
        <i class="bi bi-lock-fill"></i>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
        <label for="password" class="form-label sr-only">Kata Sandi</label>
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      {{-- Remember Me --}}
      <div class="mb-4 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Ingat saya</label>
      </div>

      {{-- Tombol dan Link --}}
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>
      </div>

      <div class="text-center mt-4">
        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
          <i class="bi bi-question-circle me-1"></i>Lupa kata sandi?
        </a>
        @endif
        @if(Route::has('register'))
        <span class="mx-2 text-muted">|</span>
        <a class="btn btn-link" href="{{ route('register') }}">
          <i class="bi bi-person-plus me-1"></i>Buat akun baru
        </a>
        @endif
      </div>
    </form>
  </div>
</div>
@endsection