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
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-send"></i> Send Password Reset Link
            </button>
          </div>

          <div class="text-center mt-3 auth-links">
            <a href="{{ route('login') }}"><i class="bi bi-arrow-left"></i> Back to Login</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection