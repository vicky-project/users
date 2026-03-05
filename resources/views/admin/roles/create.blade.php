@extends('coreui::layouts.admin')
@section('title', 'Create Role')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Create New Role</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.roles.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Permissions</label>
            @foreach($permissions as $permission)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}" {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="perm_{{ $permission->id }}">
                {{ $permission->name }}
              </label>
            </div>
            @endforeach
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection