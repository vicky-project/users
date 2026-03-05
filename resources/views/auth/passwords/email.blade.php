@extends('users::layouts.auth')
@section('title', 'Atur Ulang Kata Sandi')
@section('content')
<div class="card">
  <div class="card-header">
    <i class="bi bi-key-fill me-2"></i>Atur Ulang Kata Sandi
  </div>
  <div class="card-body">
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="form-label">Alamat Email</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
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

      <!-- Tombol Kirim -->
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-send-fill me-2"></i>Kirim Tautan Reset
        </button>
      </div>

      <!-- Kembali ke Login -->
      <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="btn btn-link p-0">
          <i class="bi bi-arrow-left me-1"></i>Kembali ke Login
        </a>
      </div>
    </form>
  </div>
</div>
@endsection