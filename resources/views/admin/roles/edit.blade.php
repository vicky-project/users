@extends('coreui::layouts.admin')
@section('title', 'Edit Role')

@section('content')
<div class="row justify-content-center">
  <div class="col-xl-10 col-lg-12">
    <div class="card border-0 shadow-sm overflow-hidden">
      <!-- Header -->
      <div class="card-header bg-white border-0 pt-4 pb-0">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
          <div>
            <h5 class="mb-1 fw-bold">
              <i class="bi bi-pencil-square me-2 text-primary"></i>
              Edit Role
            </h5>
            <p class="text-muted small mb-0">
              Perbarui informasi role dan hak akses
            </p>
          </div>
          <div class="mt-2 mt-sm-0">
            <span class="badge bg-light text-dark">
              <i class="bi bi-shield-lock me-1"></i> {{ $role->name }}
            </span>
          </div>
        </div>
      </div>

      <div class="card-body p-4">
        <form action="{{ route('admin.roles.update', $role) }}" method="POST" id="editRoleForm">
          @csrf
          @method('PUT')

          <div class="row g-4">
            <!-- Kolom Kiri: Informasi Role -->
            <div class="col-lg-6">
              <div class="border-bottom pb-2 mb-3">
                <h6 class="fw-semibold mb-0">
                  <i class="bi bi-info-circle me-2 text-primary"></i>Informasi Role
                </h6>
              </div>

              <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Role</label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-tag"></i></span>
                  <input type="text" class="form-control @error('name') is-invalid @enderror border-start-0"
                  id="name" name="name" value="{{ old('name', $role->name) }}" required>
                </div>
                @error('name') <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <!-- Optional: Guard name (if using multiple guards) -->
              @if(isset($role->guard_name))
              <div class="mb-3">
                <label for="guard_name" class="form-label fw-semibold">Guard Name</label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-shield"></i></span>
                  <input type="text" class="form-control border-start-0"
                  id="guard_name" value="{{ $role->guard_name }}" readonly disabled>
                </div>
              </div>
              @endif
            </div>

            <!-- Kolom Kanan: Permissions -->
            <div class="col-lg-6">
              <div class="border-bottom pb-2 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="fw-semibold mb-0">
                    <i class="bi bi-key me-2 text-primary"></i>Hak Akses (Permissions)
                  </h6>
                  <span class="selected-count" id="selectedCount">{{ count($rolePermissions) }}</span>
                </div>
              </div>

              <div class="mb-3">
                <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="selectAllPermsBtn">
                  <i class="bi bi-check2-square me-1"></i> Pilih Semua
                </button>

                <div class="row g-3" id="permsContainer">
                  @foreach($permissions as $permission)
                  <div class="col-md-6">
                    <div class="permission-card p-3 h-100">
                      <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                          <input class="form-check-input perm-checkbox"
                          type="checkbox"
                          name="permissions[]"
                          value="{{ $permission->name }}"
                          id="perm_{{ $permission->id }}"
                          {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                        </div>
                        <div class="flex-grow-1 ms-3">
                          <label class="fw-semibold mb-1 d-block" for="perm_{{ $permission->id }}">
                            {{ $permission->name }}
                          </label>
                          @if($permission->description)
                          <small class="text-muted d-block">{{ $permission->description }}</small>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <!-- Action buttons -->
          <div class="form-actions mt-4 p-3 d-flex justify-content-end gap-2">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
              <i class="bi bi-x-circle me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary" id="saveBtn">
              <i class="bi bi-save me-1"></i> Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
  const permCheckboxes = document.querySelectorAll('.perm-checkbox');
  const selectedCountSpan = document.getElementById('selectedCount');
  const selectAllBtn = document.getElementById('selectAllPermsBtn');
  const form = document.getElementById('editRoleForm');

  function updateSelectedCount() {
  const checked = Array.from(permCheckboxes).filter(cb => cb.checked).length;
  selectedCountSpan.textContent = checked;
  }

  selectAllBtn.addEventListener('click', function() {
  const allChecked = Array.from(permCheckboxes).every(cb => cb.checked);
  permCheckboxes.forEach(cb => cb.checked = !allChecked);
  updateSelectedCount();
  });

  permCheckboxes.forEach(cb => {
  cb.addEventListener('change', updateSelectedCount);
  });
  updateSelectedCount();

  form.addEventListener('submit', function() {
  const btn = document.getElementById('saveBtn');
  btn.disabled = true;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...';
  });
  });
</script>
@endpush

@push('styles')
<style>
  .permission-card {
    transition: all 0.2s ease;
    border: 1px solid rgba(0,0,0,0.125);
    border-radius: 0.75rem;
    background: var(--tg-theme-bg-color, #fff);
    }
    .permission-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border-color: var(--tg-theme-button-color, #0d6efd);
    }
    .perm-checkbox {
    width: 1.2rem;
    height: 1.2rem;
    margin-top: 0.15rem;
    accent-color: var(--tg-theme-button-color, #0d6efd);
    }
    .perm-badge {
    background: rgba(var(--tg-theme-button-color-rgb, 13,110,253), 0.1);
    color: var(--tg-theme-button-color, #0d6efd);
    font-weight: 500;
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.75rem;
    }
    .selected-count {
    background: var(--tg-theme-button-color, #0d6efd);
    color: var(--tg-theme-button-text-color, white);
    border-radius: 2rem;
    padding: 0.2rem 0.6rem;
    font-size: 0.8rem;
    font-weight: 500;
    }
    .form-actions {
    background: var(--tg-theme-secondary-bg-color, #f8f9fa);
    border-radius: 0 0 0.75rem 0.75rem;
    }
    @media (max-width: 768px) {
    .permission-card .col-auto {
    width: 100%;
    margin-bottom: 0.5rem;
    }
    }
    </style>
    @endpush