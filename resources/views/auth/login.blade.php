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

      <!-- Password dengan toggle -->
      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
          <input type="password" class="form-control @error('password') is-invalid @enderror"
          id="password" name="password" placeholder="••••••••" required>
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="bi bi-eye-fill" id="toggleIcon"></i>
          </button>
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

    @php
    $socialProviders = [];
    if(Module::has("SocialAccount") && Module::isEnabled('SocialAccount') && class_exists(\Modules\SocialAccount\Services\SocialProviderManager::class)) {
    $manager = app(\Modules\SocialAccount\Services\SocialProviderManager::class);
    $socialProviders = $manager->getProviders();
    }
    @endphp

    @if(!empty($socialProviders))
    <div class="social-login mt-4">
      <div class="text-center mb-3">
        Atau masuk dengan
      </div>
      <div class="d-flex flex-column gap-2">
        @foreach($socialProviders as $provider)
        <a href="{{ $provider->getLoginUrl() }}" class="btn btn-outline-secondary social-btn">
          <i class="{{ $provider->getIcon() }}"></i> {{ $provider->getLabel() }}
        </a>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
  const togglePassword = document.getElementById('togglePassword');
  const password = document.getElementById('password');
  const toggleIcon = document.getElementById('toggleIcon');

  togglePassword.addEventListener('click', function() {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);

  if (type === 'password') {
  toggleIcon.classList.remove('bi-eye-slash-fill');
  toggleIcon.classList.add('bi-eye-fill');
  } else {
  toggleIcon.classList.remove('bi-eye-fill');
  toggleIcon.classList.add('bi-eye-slash-fill');
  }
  });
</script>
@endpush