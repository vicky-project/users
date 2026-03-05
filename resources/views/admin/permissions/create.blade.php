@extends('coreui::layouts.admin')
@section('title', 'Create Permission')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Create New Permission</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.permissions.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <div class="mb-3">
            <label for="guard_name" class="form-label">Guard Name</label>
            <input type="text" class="form-control @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name" value="{{ old('guard_name', 'web') }}">
            @error('guard_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection