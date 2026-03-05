@extends('users::layouts.auth')
@section('title', 'Reset Password')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-key"></i> Reset Password
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="mb-3">
            <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $email ?? old('email') }}" required autofocus readonly>
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label"><i class="bi bi-lock"></i> New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Enter new password (min. 8 characters)">
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password-confirm" class="form-label"><i class="bi bi-lock-fill"></i> Confirm New Password</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required placeholder="Confirm new password">
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-check-circle"></i> Reset Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection