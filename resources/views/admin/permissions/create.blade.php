@extends('coreui::layouts.admin')
@section('title', 'Create Permission')

@section('content')
<div class="row justify-content-center">
  <div class="col-xl-8 col-lg-10">
    <div class="card form-card">
      <!-- Header -->
      <div class="form-header">
        <div class="d-flex align-items-center">
          <i class="bi bi-plus-circle-fill me-2 text-primary fs-4"></i>
          <h5 class="mb-0 fw-bold">Create New Permission</h5>
        </div>
        <p class="text-muted small mb-0 mt-1">
          Tambahkan hak akses baru untuk mengontrol fitur di aplikasi
        </p>
      </div>

      <div class="form-body">
        <form action="{{ route('admin.permissions.store') }}" method="POST" id="createPermForm">
          @csrf

          <div class="row g-4">
            <div class="col-12">
              <div class="mb-3">
                <label for="name" class="form-label fw-semibold">
                  <i class="bi bi-tag me-1"></i> Permission Name
                </label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-end-0">
                    <i class="bi bi-key"></i>
                  </span>
                  <input type="text" class="form-control @error('name') is-invalid @enderror border-start-0"
                  id="name" name="name" value="{{ old('name') }}"
                  placeholder="e.g., view_dashboard, edit_user, delete_post" required>
                </div>
                @error('name') <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
                @enderror
                <div class="form-text">
                  Gunakan format snake_case (huruf kecil dan underscore) untuk konsistensi.
                </div>
              </div>

              <div class="mb-3">
                <label for="guard_name" class="form-label fw-semibold">
                  <i class="bi bi-shield me-1"></i> Guard Name
                </label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-end-0">
                    <i class="bi bi-shield-lock"></i>
                  </span>
                  <input type="text" class="form-control @error('guard_name') is-invalid @enderror border-start-0"
                  id="guard_name" name="guard_name" value="{{ old('guard_name', 'web') }}">
                </div>
                @error('guard_name') <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
                @enderror
                <div class="form-text">
                  Biasanya "web" untuk aplikasi utama, "api" untuk API. Biarkan default jika tidak yakin.
                </div>
              </div>
            </div>
          </div>

          <!-- Action buttons -->
          <div class="form-actions mt-4">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
              <i class="bi bi-x-circle me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary" id="saveBtn">
              <i class="bi bi-save me-1"></i> Simpan Permission
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
  document.getElementById('createPermForm').addEventListener('submit', function() {
  const btn = document.getElementById('saveBtn');
  btn.disabled = true;
  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...';
  });
</script>
@endpush

@push('styles')
<style>
  .form-card {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
  }
  .form-header {
    background: var(--tg-theme-secondary-bg-color, #f8f9fa);
    border-bottom: 1px solid var(--tg-theme-border-color, #dee2e6);
    border-radius: 1rem 1rem 0 0;
    padding: 1rem 1.5rem;
    }
    .form-body {
    padding: 1.5rem;
    }
    .form-actions {
    background: var(--tg-theme-secondary-bg-color, #f8f9fa);
    border-radius: 0 0 1rem 1rem;
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
    }
    .input-group-text {
    background-color: var(--tg-theme-bg-color, #fff);
    border-right: none;
    }
    .form-control:focus {
    border-color: var(--tg-theme-button-color, #0d6efd);
    box-shadow: 0 0 0 0.2rem rgba(var(--tg-theme-button-color-rgb, 13,110,253), 0.25);
    }
    </style>
    @endpush