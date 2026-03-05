@extends('coreui::layouts.admin')
@section('title', 'Edit User')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Edit User: {{ $user->name }}</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
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
            <label for="password" class="form-label">Password (leave blank to keep current)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Roles</label>
            @foreach($roles as $role)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" {{ in_array($role->id, old('roles', $userRoles)) ? 'checked' : '' }}>
              <label class="form-check-label" for="role_{{ $role->id }}">
                {{ $role->name }}
              </label>
            </div>
            @endforeach
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection