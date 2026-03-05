@extends('users::layouts.auth')
@section('title', 'Register')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-person-plus"></i> Register
      </div>
      <div class="card-body p-4">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label"><i class="bi bi-person"></i> Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your name">
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label"><i class="bi bi-lock"></i> Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Enter password (min. 8 characters)">
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="mb-3">
            <label for="password-confirm" class="form-label"><i class="bi bi-lock-fill"></i> Confirm Password</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required placeholder="Confirm your password">
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-person-plus"></i> Register
            </button>
          </div>

          <div class="text-center mt-3 auth-links">
            <span>Already have an account? <a href="{{ route('login') }}">Login</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection