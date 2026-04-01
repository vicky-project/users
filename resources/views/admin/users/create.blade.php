@extends('coreui::layouts.admin')
@section('title', 'Create User')

@section('content')
<div class="row justify-content-center">
  <div class="col-xl-10 col-lg-12">
    <div class="card border-0 shadow-sm overflow-hidden">
      <!-- Header -->
      <div class="card-header bg-white border-0 pt-4 pb-0">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
          <div>
            <h5 class="mb-1 fw-bold">
              <i class="bi bi-person-plus-fill me-2 text-primary"></i>
              Create New User
            </h5>
            <p class="text-muted small mb-0">
              Tambah pengguna baru dan tentukan role aksesnya
            </p>
          </div>
        </div>
      </div>

      <div class="card-body p-4">
        <form action="{{ route('admin.users.store') }}" method="POST" id="createUserForm">
          @csrf

          <div class="row g-4">
            <!-- Kolom Kiri: Informasi User -->
            <div class="col-lg-6">
              <div class="border-bottom pb-2 mb-3">
                <h6 class="fw-semibold mb-0">
                  <i class="bi bi-person-badge me-2 text-primary"></i>Informasi Akun
                </h6>
              </div>

              <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-person"></i></span>
                  <input type="text" class="form-control @error('name') is-invalid @enderror border-start-0"
                  id="name" name="name" value="{{ old('name') }}" required>
                </div>
                @error('name') <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Alamat Email</label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-envelope"></i></span>
                  <input type="email" class="form-control @error('email') is-invalid @enderror border-start-0"
                  id="email" name="email" value="{{ old('email') }}" required>
                </div>
                @error('email') <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <div class="input-group position-relative">
                  <span class="input-group-text bg-transparent border-end-0"><i class="bi bi-key"></i></span>
                  <input type="password" class="form-control @error('password') is-invalid @enderror border-start-0"
                  id="password" name="password" required>
                  <span class="password-toggle" onclick="togglePassword()">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                  </span>
                </div>
                @error('password') <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
                @enderror
                <div class="form-text" id="passwordStrength"></div>
              </div>
            </div>

            <!-- Kolom Kanan: Roles -->
            <div class="col-lg-6">
              <div class="border-bottom pb-2 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="fw-semibold mb-0">
                    <i class="bi bi-shield-lock me-2 text-primary"></i>Role Assignment
                  </h6>
                  <span class="selected-count" id="selectedCount">0</span>
                </div>
              </div>

              <div class="mb-3">
                <div class="d-flex gap-2 mb-3">
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="selectAllRolesBtn">
                    <i class="bi bi-check2-square me-1"></i> Pilih Semua
                  </button>
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAllRolesBtn">
                    <i class="bi bi-square me-1"></i> Hapus Semua
                  </button>
                </div>

                <div class="row g-3" id="rolesContainer">
                  @foreach($roles as $role)
                  <div class="col-md-6">
                    <div class="role-card p-3 h-100">
                      <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                          <input class="form-check-input role-checkbox"
                          type="checkbox"
                          name="roles[]"
                          value="{{ $role->id }}"
                          id="role_{{ $role->id }}"
                          {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
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
                          <span class="badge bg-light text-dark">{{ $role->permissions->count() }} permissions</span>
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
          <div class="form-actions mt-4">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
              <i class="bi bi-x-circle me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary" id="saveBtn">
              <i class="bi bi-save me-1"></i> Simpan Pengguna
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
  const roleCheckboxes = document.querySelectorAll('.role-checkbox');
  const selectedCountSpan = document.getElementById('selectedCount');
  const selectAllBtn = document.getElementById('selectAllRolesBtn');
  const deselectAllBtn = document.getElementById('deselectAllRolesBtn');
  const form = document.getElementById('createUserForm');

  function updateSelectedCount() {
  const checked = Array.from(roleCheckboxes).filter(cb => cb.checked).length;
  selectedCountSpan.textContent = checked;
  }

  selectAllBtn.addEventListener('click', function() {
  roleCheckboxes.forEach(cb => cb.checked = true);
  updateSelectedCount();
  });

  deselectAllBtn.addEventListener('click', function() {
  roleCheckboxes.forEach(cb => cb.checked = false);
  updateSelectedCount();
  });

  roleCheckboxes.forEach(cb => {
  cb.addEventListener('change', updateSelectedCount);
  });
  updateSelectedCount();

  // Password toggle visibility
  window.togglePassword = function() {
  const passwordInput = document.getElementById('password');
  const icon = document.getElementById('toggleIcon');
  if (passwordInput.type === 'password') {
  passwordInput.type = 'text';
  icon.classList.remove('bi-eye-slash');
  icon.classList.add('bi-eye');
  } else {
  passwordInput.type = 'password';
  icon.classList.remove('bi-eye');
  icon.classList.add('bi-eye-slash');
  }
  };

  // Password strength indicator (optional)
  const passwordInput = document.getElementById('password');
  const strengthDiv = document.getElementById('passwordStrength');
  if (passwordInput && strengthDiv) {
  passwordInput.addEventListener('input', function() {
  const val = this.value;
  if (val.length === 0) {
  strengthDiv.innerHTML = '';
  return;
  }
  let strength = 'Lemah';
  let color = 'danger';
  if (val.length >= 8 && /[A-Z]/.test(val) && /[0-9]/.test(val) && /[^a-zA-Z0-9]/.test(val)) {
  strength = 'Kuat';
  color = 'success';
  } else if (val.length >= 6 && /[A-Z]/.test(val) && /[0-9]/.test(val)) {
  strength = 'Sedang';
  color = 'warning';
  }
  strengthDiv.innerHTML = `<span class="text-${color}">Kekuatan password: ${strength}</span>`;
  });
  }

  // Loading state on submit
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
    border-radius: 0 0 1rem 1rem;
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
    }
    .password-toggle {
    cursor: pointer;
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    }
    .input-group {
    position: relative;
    }
    .input-group .form-control {
    padding-right: 2.5rem;
    }
    @media (max-width: 768px) {
    .role-card .col-auto {
    width: 100%;
    margin-bottom: 0.5rem;
    }
    }
    </style>
    @endpush