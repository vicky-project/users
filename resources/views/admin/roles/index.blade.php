@extends('coreui::layouts.admin')
@section('title', 'Manage Roles')
@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Roles</h5>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
      <i class="bi bi-plus"></i> Add New
    </a>
  </div>
  <div class="card-body">
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Permissions</th>
            <th width="200">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $role)
          <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>
              @foreach($role->permissions as $permission)
              <span class="badge bg-info">{{ $permission->name }}</span>
              @endforeach
            </td>
            <td>
              <div class="btn-group btn-group-sm">
                <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-warning" title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>
                <a href="{{ route('admin.roles.assign-permissions', $role) }}" class="btn btn-sm btn-success" title="Assign Permissions">
                  <i class="bi bi-shield"></i>
                </a>
                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center">
      {{ $roles->links() }}
    </div>
  </div>
</div>
@endsection