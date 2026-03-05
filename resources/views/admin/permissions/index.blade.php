@extends('coreui::layouts.admin')
@section('title', 'Manage Permissions')
@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Permissions</h5>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
      <i class="bi bi-plus"></i> Add New
    </a>
  </div>
  <div class="card-body">
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Guard</th>
          <th width="150">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($permissions as $permission)
        <tr>
          <td>{{ $permission->id }}</td>
          <td>{{ $permission->name }}</td>
          <td>{{ $permission->guard_name }}</td>
          <td>
            <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-sm btn-warning" title="Edit">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="d-flex justify-content-center">
      {{ $permissions->links() }}
    </div>
  </div>
</div>
@endsection