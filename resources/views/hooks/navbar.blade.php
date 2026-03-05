@use('\Modules\Users\Constants\Permission')

@can(Permission::ACCESS_USERS)
<li class="nav-item">
  <a class="nav-link" href="{{ route('admin.dashboard') }}">
    <i class="bi bi-speedometer2"></i> Admin
  </a>
</li>
@endcan