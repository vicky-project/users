@extends('coreui::layouts.admin')
@section('title', 'Assign Roles to ' . $user->name)

@section('content')
<div class="row justify-content-center">
  <div class="col-xl-8 col-lg-10">
    <div class="card border-0 shadow-sm overflow-hidden">
      <!-- Header dengan gradien ringan -->
      <div class="card-header bg-white border-0 pt-4 pb-0">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
          <div>
            <h5 class="mb-1 fw-bold">
              <i class="bi bi-shield-lock me-2 text-primary"></i>
              Assign Roles
            </h5>
            <p class="text-muted small mb-0">
              Kelola hak akses untuk pengguna <strong>{{ $user->name }}</strong>
            </p>
          </div>
          <div class="mt-2 mt-sm-0">
            <span class="badge bg-light text-dark">
              <i class="bi bi-person-circle me-1"></i> {{ $user->email }}
            </span>
          </div>
        </div>
      </div>

      <div class="card-body p-4">
        <form action="{{ route('admin.users.assign-roles.update', $user) }}" method="POST" id="roleForm">
          @csrf
          <input type="hidden" name="roles" id="rolesHidden" value="">

          <!-- Summary bar -->
          <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div class="d-flex gap-2">
              <span class="fw-semibold">Total Roles:</span>
              <span class="selected-count" id="selectedCount">{{ count($userRoles) }}</span>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="selectAllBtn">
              <i class="bi bi-check2-square me-1"></i> Select All
            </button>
          </div>

          <!-- Daftar roles dalam grid modern -->
          <div class="row g-3" id="rolesContainer">
            @foreach($roles as $role)
            <div class="col-md-6 col-xl-4">
              <div class="role-card p-3 h-100">
                <div class="d-flex align-items-start">
                  <div class="flex-shrink-0">
                    <input class="form-check-input role-checkbox"
                    type="checkbox"
                    name="roles[]"
                    value="{{ $role->name }}"
                    id="role_{{ $role->id }}"
                    {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <label class="fw-semibold mb-1 d-block" for="role_{{ $role->id }}">
                      {{ $role->name }}
                    </label>
                    @if($role->description)
                    <small class="text-muted d-block">{{ $role->description }}</small>
                    @else
                    <small class="text-muted">Tidak ada deskripsi</small>
                    @endif
                  </div>
                  <div class="flex-shrink-0">
                    <span class="role-badge">{{ $role->permissions->count() }} permissions</span>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Action buttons -->
          <div class="form-actions mt-4 p-3 d-flex justify-content-end gap-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
              <i class="bi bi-x-circle me-1"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary" id="saveBtn">
              <i class="bi bi-save me-1"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Informasi tambahan (opsional) -->
    <div class="mt-3 text-center">
      <small class="text-muted">
        <i class="bi bi-info-circle"></i> Perubahan akan langsung berlaku setelah disimpan.
      </small>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
  const checkboxes = document.querySelectorAll('.role-checkbox');
  const selectedCountSpan = document.getElementById('selectedCount');
  const selectAllBtn = document.getElementById('selectAllBtn');
  const form = document.getElementById('roleForm');

  // Update counter
  function updateSelectedCount() {
  const checked = document.querySelectorAll('.role-checkbox:checked').length;
  selectedCountSpan.textContent = checked;
  }

  // Toggle select all
  selectAllBtn.addEventListener('click', function() {
  const allChecked = Array.from(checkboxes).every(cb => cb.checked);
  checkboxes.forEach(cb => cb.checked = !allChecked);
  updateSelectedCount();
  });

  // Update counter on change
  checkboxes.forEach(cb => {
  cb.addEventListener('change', updateSelectedCount);
  });

  // Initial count
  updateSelectedCount();

  // Optional: Show loading on submit
  form.addEventListener('submit', function() {
  const btn = document.getElementById('saveBtn');
  btn.disabled = true;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Saving...';
  });
  });
</script>
@endpush

@push('styles')
<style>
  .role-card {
    transition: all 0.2s ease;
    border: 1px solid rgba(0,0,0,0.125);
    border-radius: 0.75rem;
    background: var(--tg-theme-bg-color, #fff);
    }
    .role-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border-color: var(--tg-theme-button-color, #0d6efd);
    }
    .role-checkbox {
    width: 1.2rem;
    height: 1.2rem;
    margin-top: 0.15rem;
    accent-color: var(--tg-theme-button-color, #0d6efd);
    }
    .role-badge {
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
    .role-card .col-auto {
    width: 100%;
    margin-bottom: 0.5rem;
    }
    }
    </style>
    @endpush