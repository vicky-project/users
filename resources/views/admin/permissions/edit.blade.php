@extends('coreui::layouts.admin')
@section('title', 'Edit Permission')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Edit Permission</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
          @csrf @method('PUT')
          <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $permission->name) }}" required>
            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label for="guard_name" class="form-label">Guard Name</label>
            <input type="text" class="form-control" id="guard_name" value="{{ $permission->guard_name }}" disabled readonly>
            <small class="text-muted">Guard name cannot be changed.</small>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection