@extends('users::layouts.auth')
@section('title', 'Register')
@section('content')
<div class="card">
  <div class="card-header">
    <i class="bi bi-person-plus-fill me-2"></i>Registration
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Nama Lengkap -->
      <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          <input type="text" class="form-control @error('name') is-invalid @enderror"
          id="name" name="name" value="{{ old('name') }}"
          placeholder="Masukkan nama lengkap" required autofocus>
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <!-- Alamat Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Alamat Email</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" class="form-control @error('email') is-invalid @enderror"
          id="email" name="email" value="{{ old('email') }}"
          placeholder="nama@email.com" required>
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <!-- Kata Sandi -->
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          <input type="password" class="form-control @error('password') is-invalid @enderror"
          id="password" name="password"
          placeholder="Minimal 8 karakter" required>
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <!-- Konfirmasi Kata Sandi -->
      <div class="mb-4">
        <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          <input type="password" class="form-control"
          id="password-confirm" name="password_confirmation"
          placeholder="Ulangi kata sandi" required>
        </div>
      </div>

      <!-- Tombol Daftar -->
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-person-plus-fill me-2"></i>Daftar
        </button>
      </div>

      <!-- Tautan ke Halaman Login -->
      <div class="text-center mt-4">
        <span class="text-muted">Sudah punya akun?</span>
        <a href="{{ route('login') }}" class="btn btn-link p-0 ms-1">
          Masuk di sini
        </a>
      </div>
    </form>
  </div>
</div>
@endsection