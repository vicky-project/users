@extends('coreui::layouts.admin')
@section('title', 'Edit Role')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Edit Role: {{ $role->name }}</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.roles.update', $role) }}" method="POST">
          @csrf @method('PUT')
          <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required>
            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Permissions</label>
            @foreach($permissions as $permission)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}" {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
              <label class="form-check-label" for="perm_{{ $permission->id }}">
                {{ $permission->name }}
              </label>
            </div>
            @endforeach
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection