@extends('coreui::layouts.app')
@section('title', 'Edit Profile')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-pencil"></i> Edit Profile
      </div>
      <div class="card-body">
        <form action="{{ route('profile.update') }}" method="POST">
          @csrf @method('PUT')
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank to keep current)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label for="password-confirm" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
          </div>
          <button type="submit" class="btn btn-primary">Update Profile</button>
          <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection