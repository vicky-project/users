@extends('users::layouts.auth')
@section('title', 'Login')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        Login
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember Me</label>
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
          @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection