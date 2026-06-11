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
            <td class="permission-cell">
              <div class="permission-badges d-flex flex-wrap gap-1">
                @foreach($role->permissions as $permission)
                <span class="badge bg-info permission-badge-item"
                  data-full="{{ $permission->name }}">
                  {{ $permission->name }}
                </span>
                @endforeach
              </div>
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

@push('scripts')
<script>
  function updatePermissionBadges() {
    document.querySelectorAll('.permission-badges').forEach(container => {
    // Kembalikan semua badge ke tampilan semula
    container.querySelectorAll('.permission-badge-item').forEach(b => {
    b.style.display = '';
    });

    // Hapus badge "more" sebelumnya
    const oldMore = container.querySelector('.more-badge');
    if (oldMore) oldMore.remove();

    const badges = Array.from(container.querySelectorAll('.permission-badge-item'));
    if (badges.length === 0) return;

    // Lebar container yang tersedia
    const maxWidth = container.offsetWidth;
    let usedWidth = 0;
    let visibleCount = 0;

    // Hitung berapa banyak badge yang bisa muat
    for (let i = 0; i < badges.length; i++) {
    const badgeWidth = badges[i].offsetWidth + 4; // 4px gap
    // Sisakan ruang untuk badge "+X more" jika bukan yang terakhir
    const reserve = (i < badges.length - 1) ? 60 : 0;
    if (usedWidth + badgeWidth + reserve > maxWidth) break;
    usedWidth += badgeWidth;
    visibleCount++;
    }

    // Sembunyikan badge yang tidak muat
    for (let i = visibleCount; i < badges.length; i++) {
    badges[i].style.display = 'none';
    }

    // Tambahkan badge "+X more" jika ada yang disembunyikan
    if (visibleCount < badges.length) {
    const hiddenCount = badges.length - visibleCount;
    const allNames = badges.map(b => b.dataset.full).join(', ');
    const more = document.createElement('span');
    more.className = 'badge bg-secondary more-badge ms-1';
    more.textContent = `+${hiddenCount} more`;
    more.setAttribute('data-bs-toggle', 'popover');
    more.setAttribute('title', 'All Permissions');
    more.setAttribute('data-bs-content', allNames);
    more.setAttribute('tabindex', '0');
    container.appendChild(more);
    // Aktifkan popover
    new bootstrap.Popover(more, { trigger: 'hover focus', html: false });
    }
    });
  }

  // Jalankan saat halaman dimuat
  window.addEventListener('load', updatePermissionBadges);
  // Jalankan ulang saat ukuran layar berubah
  window.addEventListener('resize', updatePermissionBadges);
</script>
@endpush