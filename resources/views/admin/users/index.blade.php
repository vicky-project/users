@extends('coreui::layouts.admin')
@section('title', 'Manage Users')
@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Users</h5>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
      <i class="bi bi-plus"></i> Add New
    </a>
  </div>
  <div class="card-body">
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Roles</th>
          <th width="200">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            @foreach($user->roles as $role)
            <span class="badge bg-info">{{ $role->name }}</span>
            @endforeach
          </td>
          <td>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning" title="Edit">
              <i class="bi bi-pencil"></i>
            </a>
            <a href="{{ route('admin.users.assign-roles', $user) }}" class="btn btn-sm btn-success" title="Assign Roles">
              <i class="bi bi-shield"></i>
            </a>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
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
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection