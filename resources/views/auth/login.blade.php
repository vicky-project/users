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

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" class="form-control @error('email') is-invalid @enderror"
          id="email" name="email" value="{{ old('email') }}"
          placeholder="nama@email.com" required autofocus>
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <div class="input-group">
          <span class="input-group-text" id="basic-addon2"><i class="bi bi-lock-fill"></i></span>
          <input type="password" class="form-control @error('password') is-invalid @enderror"
          id="password" name="password" placeholder="••••••••" required>
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <!-- Remember Me -->
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">Ingat saya</label>
      </div>

      <!-- Submit Button -->
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>
      </div>

      <!-- Links -->
      <div class="d-flex justify-content-between align-items-center mt-4">
        @if (Route::has('password.request'))
        <a class="btn btn-link p-0" href="{{ route('password.request') }}">
          <i class="bi bi-question-circle me-1"></i>Lupa kata sandi?
        </a>
        @endif
        @if(Route::has('register'))
        <a class="btn btn-link p-0" href="{{ route('register') }}">
          <i class="bi bi-person-plus me-1"></i>Buat akun baru
        </a>
        @endif
      </div>
    </form>
  </div>
</div>
@endsection