@extends('coreui::layouts.app')
@section('title', 'My Profile')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <i class="bi bi-person-circle"></i> My Profile
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 text-center mb-3">
            <img src="{{ $user->avatar }}"
            class="rounded-circle img-fluid border shadow-sm"
            alt="Avatar"
            style="max-width: 150px;">
          </div>
          <div class="col-md-9">
            <table class="table table-borderless">
              <tr>
                <th width="150" class="text-muted">Name</th>
                <td><strong>{{ $user->name }}</strong></td>
              </tr>
              <tr>
                <th class="text-muted">Email</th>
                <td>{{ $user->email }}</td>
              </tr>
              <tr>
                <th class="text-muted">Member since</th>
                <td>{{ $user->created_at->format('d F Y') }}</td>
              </tr>
            </table>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
              <i class="bi bi-pencil"></i> Edit Profile
            </a>
          </div>
        </div>
      </div>
    </div>
    @if(Module::isEnabled('SocialAccount'))
    @include('socialaccount::profile.index', [
    'connectedAccounts' => auth()->user()->socialAccounts,
    'providers' => app(\Modules\SocialAccount\Services\SocialProviderManager::class)->getProviders()
    ])
    @endif
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      @if($isTrusted)
      <span>
        <i class="bi bi-shield-check text-success me-1 fs-2"></i>
        Perangkat terverifikasi.
      </span>
      <button type="button" class="btn btn-danger" onclick="trustToggle();">
        <i class="bi bi-x-lg me-1"></i>
        Batalkan
      </button>
      @else
      <span>
        <i class="bi bi-shield-exclamation text-danger me-1 fs-2"></i>
        Perangkat tidak terverifikasi.
      </span>
      <button type="button" class="btn btn-success" onclick="trustToggle();">
        <i class="bi bi-check2-all me-1"></i>
        Verifikasi
      </button>
      @endif
    </div>
  </div>
</div>

<!-- Ringkasan Statistik -->
<div class="row mb-4 pt-2 mt-3 border-top border-primary">
  <div class="col-md-12">
    <div class="summary-box">
      <h6 class="fw-bold text-primary mb-2">
        <i class="bi bi-bar-chart me-2"></i>Ringkasan Aktivitas Login
      </h6>
      <div class="row">
        <!-- Total Logins -->
        <div class="col-md-4">
          <div class="d-flex align-items-center mb-3">
            <div class="stat-icon primary-bg me-3">
              <i class="bi bi-door-open"></i>
            </div>
            <div>
              <div class="stat-value text-primary">
                {{ $user->getTotalLogins() }}
              </div>
              <div class="stat-label">
                Total Login
              </div>
              <span class="badge-stat bg-primary bg-opacity-10 text-primary">Seluruh waktu</span>
            </div>
          </div>
        </div>

        <!-- Failed Attempts -->
        <div class="col-md-4">
          <div class="d-flex align-items-center mb-3">
            <div class="stat-icon danger-bg me-3">
              <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div>
              <div class="stat-value text-danger">
                {{ $user->getFailedAttempts() }}
              </div>
              <div class="stat-label">
                Upaya Gagal
              </div>
              @if($user->getFailedAttempts() > 0)
              <span class="badge-stat bg-danger bg-opacity-10 text-danger">Perlu diperhatikan</span>
              @else
              <span class="badge-stat bg-success bg-opacity-10 text-success">Aman</span>
              @endif
            </div>
          </div>
        </div>

        <!-- Unique Devices -->
        <div class="col-md-4">
          <div class="d-flex align-items-center mb-3">
            <div class="stat-icon info-bg me-3">
              <i class="bi bi-phone"></i>
            </div>
            <div>
              <div class="stat-value text-info">
                {{ $user->getUniqueDevicesCount() }}
              </div>
              <div class="stat-label">
                Perangkat Unik
              </div>
              <span class="badge-stat bg-info bg-opacity-10 text-info">Aktif</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Tombol ke Halaman Detail -->
      <div class="mt-3 text-center">
        <a href="{{ route('authlog.statistics', $user) }}" class="btn btn-outline-primary">
          <i class="bi bi-eye me-2"></i> Lihat Detail Lengkap & Kelola Sesi
        </a>
      </div>
    </div>
  </div>
</div>

<div class="last-updated mb-3">
  <i class="bi bi-clock me-1"></i> Data diperbarui secara real-time dari sistem log management
</div>
@endsection

@push('scripts')
<script>
  async function trustToggle() {
    @if($isTrusted)
    if (!confirm('Are you sure to untrust this device ?')) return;
    @endif

    const showAlertExist = typeof showToast === 'function';

    try {
      const response = await fetch("{{ secure_url(config('app.url'))}}/authlog/trusted-device", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ device_id: '{{ $device }}'})
      });

      const data = await response.json();

      if (data.success) {
        if (showAlertExist) {
          showToast('Success', data.message || 'Operation success', 'success');
        } else {
          alert(data.message);
        }

        // Reload page after 1.5 seconds
        setTimeout(() => {
        window.location.reload();
        }, 1500);
      } else {
        if (showAlertExist) {
          showToast('Error', data.message, 'danger');
        } else {
          alert(data.message)
        }
      }
    } catch(error) {
      console.error(error);
      if (showAlertExist) {
        showToast('Error', error.message || 'Failed to do this operation.', 'danger');
      } else {
        alert(error.message);
      }
    }
  }
</script>
@endpush

@push('styles')
<style>
  .stat-item {
    padding: 1.25rem 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  }

  .stat-item:last-child {
    border-bottom: none;
  }

  .stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin-right: 1rem;
  }

  .stat-value {
    font-weight: 800;
    font-size: 1.8rem;
    line-height: 1.2;
  }

  .stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
  }

  .badge-stat {
    font-size: 0.75rem;
    padding: 4px 10px;
    border-radius: 50px;
  }

  .primary-bg {
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary-color);
  }

  .success-bg {
    background-color: rgba(6, 214, 160, 0.1);
    color: var(--success-color);
  }

  .warning-bg {
    background-color: rgba(255, 209, 102, 0.1);
    color: #e6ac00;
  }

  .danger-bg {
    background-color: rgba(239, 71, 111, 0.1);
    color: var(--danger-color);
  }

  .info-bg {
    background-color: rgba(17, 138, 178, 0.1);
    color: var(--info-color);
  }

  .summary-box {
    background-color: var(--light-bg);
    border-radius: 12px;
    padding: 1rem;
    margin-top: 1.5rem;
  }

  .last-updated {
    font-size: 0.85rem;
    color: #6c757d;
    text-align: center;
    margin-top: 1rem;
  }

  @media (max-width: 768px) {
    .stat-value {
      font-size: 1.5rem;
    }

    .stat-icon {
      width: 50px;
      height: 50px;
      font-size: 1.5rem;
    }
  }
</style>
@endpush