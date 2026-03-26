@extends('coreui::layouts.app')
@section('title', 'Log Statistics')
@section('content')
<div class="row justify-content-center">
  <div class="col-12">
    <div class="card border-0 shadow-sm" style="background-color: var(--tg-theme-secondary-bg-color);">
      <div class="card-header py-3" style="background-color: transparent;border-bottom: 1px solid var(--tg-theme-hint-color);">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0 fw-bold" style="color: var(--tg-theme-text-color):">
            <i class="bi bi-shield-check me-2" style="color: var(--tg-theme-button-color);"></i>Detail Keamanan & Manajemen Sesi
          </h5>
        </div>
      </div>
      <div class="card-body p-4">

        <!-- Statistik Lengkap -->
        <div class="row mb-5">
          <div class="col-12">
            <h6 class="fw-bold mb-3 border-bottom pb-2" style="color: var(--tg-theme-text-color);border-color: var(--tg-theme-hint-color) !important;">
              <i class="bi bi-bar-chart me-2" style="color: var(--tg-theme-button-color);"></i>Statistik Aktivitas
            </h6>
            <div class="row">
              <!-- Total Logins -->
              <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card text-center p-3 rounded" style="background-color: var(--tg-theme-bg-color);border: 1px solid var(--tg-theme-hint-color);">
                  <div class="stat-icon mb-2 mx-auto" style="background-color: rgba(var(--tg-theme-button-color-rgb, 64, 167, 227), 0.1);color: var(--tg-theme-button-color);">
                    <i class="bi bi-door-open"></i>
                  </div>
                  <div class="stat-value" style="color: var(--tg-theme-text-color);font-size: 1.5rem;font-weight: bold;">
                    {{ $stats['total_logins'] }}
                  </div>
                  <div class="stat-label" style="color: var(--tg-theme-hint-color);">
                    Total Login
                  </div>
                </div>
              </div>

              <!-- Failed Attempts -->
              <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card text-center p-3 rounded" style="background-color: var(--tg-theme-bg-color);border: 1px solid var(--tg-theme-hint-color);">
                  <div class="stat-icon mb-2 mx-auto" style="background-color: rgba(220, 53, 69, 0.1);color: #dc3545">
                    <i class="bi bi-exclamation-triangle"></i>
                  </div>
                  <div class="stat-value" style="color: #dc3545;font-size: 1.5rem;font-weight: bold;">
                    {{ $stats['failed_attempts'] }}
                  </div>
                  <div class="stat-label" style="color: var(--tg-theme-hint-color);">
                    Upaya Gagal
                  </div>
                </div>
              </div>

              <!-- Unique Devices -->
              <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card text-center p-3 rounded" style="background-color: var(--tg-theme-bg-color);border: 1px solid var(--tg-theme-hint-color);">
                  <div class="stat-icon mb-2 mx-auto" style="background-color: rgba(13, 202, 240, 0.1);color: #0dcaf0;">
                    <i class="bi bi-phone"></i>
                  </div>
                  <div class="stat-value" style="color: #0dcaf0;font-size: 1.5rem;font-weight: bold;">
                    {{ $stats['unique_devices'] }}
                  </div>
                  <div class="stat-label" style="color: var(--tg-theme-hint-color);">
                    Perangkat Unik
                  </div>
                </div>
              </div>

              <!-- Unique IPs -->
              <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card text-center p-3 rounded" style="background-color: var(--tg-theme-bg-color);border: 1px solid var(--tg-theme-hint-color);">
                  <div class="stat-icon mb-2 mx-auto" style="background-color: rgba(13, 202, 240, 0.1);color: #0dcaf0">
                    <i class="bi bi-globe"></i>
                  </div>
                  <div class="stat-value" style="color: #0dcaf0;font-size: 1.5rem;font-weight: bold;">
                    {{ $stats['unique_ips'] }}
                  </div>
                  <div class="stat-label" style="color: var(--tg-theme-hint-color);">
                    IP Unik
                  </div>
                </div>
              </div>

              <!-- Last 30 Days -->
              <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card text-center p-3 rounded" style="background-color: var(--tg-theme-bg-color);border: 1px solid var(--tg-theme-hint-color);">
                  <div class="stat-icon mb-2 mx-auto" style="background-color: rgba(255, 193, 7, 0.1);color: #e6ac00;">
                    <i class="bi bi-calendar-month"></i>
                  </div>
                  <div class="stat-value" style="color: #e6ac00;font-size: 1.5rem;font-weight: bold;">
                    {{ $stats['last_30_days'] }}
                  </div>
                  <div class="stat-label" style="color: var(--tg-theme-hint-color);">
                    30 Hari Terakhir
                  </div>
                </div>
              </div>

              <!-- Last 7 Days -->
              <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card text-center p-3 rounded" style="background-color: var(--tg-theme-bg-color);boder: 1px solid var(--tg-theme-hint-color);">
                  <div class="stat-icon mb-2 mx-auto" style="background-color: rgba(255, 193, 7, 0.1);color: #e6ac00;">
                    <i class="bi bi-calendar-week"></i>
                  </div>
                  <div class="stat-value" style="color: #e6ac00;font-size: 1.5rem;fon: bold;">
                    {{ $stats['last_7_days'] }}
                  </div>
                  <div class="stat-label" style="color: var(--tg-theme-hint-color);">
                    7 Hari Terakhir
                  </div>
                </div>
              </div>

              <!-- Suspicious Activities -->
              <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card text-center p-3 rounded" style="background-color: var(--tg-theme-bg-color);boder: 1px solid var(--tg-theme-hint-color);">
                  <div class="stat-icon mb-2 mx-auto" style="background-color: {{ $stats['suspicious_activities'] > 0 ? 'rgba(220, 53, 69, 0.1)' : 'rgba(25, 135, 84, 0.1)'}};">
                    <i class="bi bi-shield-exclamation"></i>
                  </div>
                  <div class="stat-value" style="color: {{ $stats['suspicious_activities'] > 0 ? '#dc3545' : '#198754'}};font-size: 1.5rem;font-weight: bold;">
                    {{ $stats['suspicious_activities'] }}
                  </div>
                  <div class="stat-label" style="color: var(--tg-theme-hint-color);">
                    Aktivitas Mencurigakan
                  </div>
                </div>
              </div>

              <!-- Trusted Devices -->
              <div class="col-md-3 col-sm-6 mb-4">
                <div class="stat-card text-center p-3 rounded" style="background-color: var(--tg-theme-bg-color);boder: 1px solid var(--tg-theme-hint-color);">
                  <div class="stat-icon mb-2 mx-auto" style="background-color: rgba(25, 135, 84, 0.1);color: #198754;">
                    <i class="bi bi-shield-check"></i>
                  </div>
                  <div class="stat-value" style="color: #198754;font-size: 1.5rem;font-weight: bold;">
                    {{ $stats['trusted_devices'] }}
                  </div>
                  <div class="stat-label" style="color: var(--tg-theme-hint-color);">
                    Perangkat Terpercaya
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sesi Aktif -->
        <div class="row mb-5">
          <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h6 class="fw-bold mb-0" style="color: var(--tg-theme-text-color);">
                <i class="bi bi-laptop me-2" style="color: var(--tg-theme-button-color);"></i>Semua Sesi ({{ $sessionsCount }})
              </h6>
              <div class="btn-group">
                <button type="button" class="btn btn-sm" onclick="revokeAllOtherSessions()" style="background-color: #dc3545;color: white;border: none;">
                  <i class="bi bi-trash me-1"></i> Cabut Semua Sesi Lain
                </button>
                <button type="button" class="btn btn-sm" onclick="revokeAllSessions()" style="background-color: #dc3545;color: white;border:none;">
                  <i class="bi bi-trash-fill me-1"></i> Cabut Semua Sesi
                </button>
              </div>
            </div>

            @if(count($activeSessions) > 0)
            <div class="table-responsive">
              <table class="table table-hover" style="color: var(--tg-theme-text-color);">
                <thead>
                  <tr style="border-bottom-color: var(--tg-theme-hint-color);">
                    <th style="color: var(--tg-theme-hint-color);">Perangkat</th>
                    <th style="color: var(--tg-theme-hint-color);">IP Address</th>
                    <th style="color: var(--tg-theme-hint-color);">Browser</th>
                    <th style="color: var(--tg-theme-hint-color);">Lokasi</th>
                    <th style="color: var(--tg-theme-hint-color);">Terakhir Aktif</th>
                    <th style="color: var(--tg-theme-hint-color);">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($activeSessions as $session)
                  @php
                  $location = $session->location;
                  @endphp
                  <tr style="border-bottom-color: var(--tg-theme-hint-color);background-color: {{ $session->is_current ? 'rgba(var(--tg-theme-button-color-rgb, 64, 167, 227), 0.1)' : 'transparent' }};">
                    <td>
                      <div class="d-flex align-items-center">
                        <i class="bi bi-{{ $session->device_type === 'mobile' ? 'phone' : 'laptop' }} me-2" style="color: var(--tg-theme-button-color);"></i>
                        <div>
                          <div class="fw-medium" style="color: var(--tg-theme-text-color);">
                            {{ $session->device_name }}
                          </div>
                          <small style="color: var(--tg-theme-hint-color);">{{ $session->platform }}</small>
                        </div>
                      </div>
                    </td>
                    <td style="color: var(--tg-theme-text-color);">{{ $session->ip_address }}</td>
                    <td style="color: var(--tg-theme-text-color);">{{ $session->browser }}</td>
                    <td>
                      @if(is_array($location) && !empty($location['country']))
                      <div class="location-info">
                        <div class="d-flex align-items-center mb-1">
                          @if(!empty($location['iso_code']))
                          <span class="country-flag me-2" style="color: var(--tg-theme-text-color);" title="{{ $location['country'] }}">
                            {{ $location['iso_code'] }}
                          </span>
                          @endif
                          <strong style="color: var(--tg-theme-text-color);">{{ $location['country'] }}</strong>
                        </div>
                        <div class="small" style="color: var(--tg-theme-hint-color);">
                          @if(!empty($location['city']))
                          <i class="bi bi-geo-alt me-1"></i>{{ $location['city'] }}
                          @endif
                          @if(!empty($location['state_name']))
                          <span class="ms-2">
                            <i class="bi bi-map me-1"></i>{{ $location['state_name'] }}
                          </span>
                          @endif
                          @if(!empty($location['postal_code']))
                          <div class="mt-1">
                            <i class="bi bi-mailbox me-1"></i>{{ $location['postal_code'] }}
                          </div>
                          @endif
                        </div>
                      </div>
                      @else
                      <span style="color: var(--tg-theme-hint-color):">Unknown</span>
                      @endif
                    </td>
                    <td style="color: var(--tg-theme-text-color);">{{ \Carbon\Carbon::parse($session->last_activity)->diffForHumans() }}</td>
                    <td>
                      @if(!$session->is_current)
                      <button class="btn btn-sm" style="background-color: transparent;color: var(--tg-theme-button-color);border: 1px solid var(--tg-theme-button-color);" onclick="revokeSession('{{ $session->id }}')">
                        <i class="bi bi-x-circle"></i> Cabut
                      </button>
                      @else
                      <span class="badge" style="background-color: var(--tg-theme-button-color);color: var(--tg-theme-button-text-color);">Sesi Saat Ini</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @else
            <div class="text-center py-5">
              <i class="bi bi-check-circle display-4" style="color: var(--tg-theme-button-color);"></i>
              <p class="mt-3" style="color: var(--tg-theme-hint-color);">
                Tidak ada sesi aktif
              </p>
            </div>
            @endif
          </div>
        </div>

        <!-- Daftar Perangkat -->
        <div class="row mb-5">
          <div class="col-12">
            <h6 class="fw-bold mb-3" style="color: var(--tg-theme-text-color);">
              <i class="bi bi-phone me-2" style="color: var(--tg-theme-button-color):"></i>Perangkat Terhubung ({{ count($devices) }})
            </h6>

            @if(count($devices) > 0)
            <div class="row">
              @foreach($devices as $device)
              <div class="col-md-6 mb-3">
                <div class="card border-0" style="background-color: var(--tg-theme-bg-color);boder: 1px solid var(--tg-theme-hint-color) !important;">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-2">
                          <i class="bi bi-{{ $device->type === 'mobile' ? 'phone' : 'laptop' }} me-2 fs-4" style="color: var(--tg-theme-button-color);"></i>
                          <div>
                            <h6 class="mb-0" style="color: var(--tg-theme-text-color);">{{ $device->name }}</h6>
                            <small style="color: var(--tg-theme-hint-color);">{{ $device->model }}</small>
                          </div>
                        </div>
                        <div class="mb-2">
                          <small class="d-block" style="color: var(--tg-theme-hint-color);">IP Address</small>
                          <span class="fw-medium" style="color: var(--tg-theme-text-color);">{{ $device->ip_address }}</span>
                        </div>
                        <div class="mb-2">
                          <small class="d-block" style="color: var(--tg-theme-hint-color);">Terakhir Aktivitas</small>
                          <span style="color: var(--tg-theme-text-color);">{{ \Carbon\Carbon::parse($device->last_active)->diffForHumans() }}</span>
                        </div>
                        @if($device->is_trusted)
                        <span class="badge" style="background-color: #198754;color: white;">
                          <i class="bi bi-shield-check"></i> Terpercaya
                        </span>
                        @endif
                        @if($device->is_current)
                        <span class="badge ms-2" style="background-color: var(--tg-theme-button-color);color: var(--tg-theme-button-text-color);">
                          <i class="bi bi-star"></i> Saat Ini
                        </span>
                        @endif
                      </div>
                      <div>
                        @if(!$device->is_current)
                        <button class="btn btn-sm" style="background-color: transparent; color: #dc3545;border: 1px solid #dc3545;" onclick="revokeDevice('{{ $device->id }}')">
                          <i class="bi bi-trash"></i>
                        </button>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            @else
            <div class="text-center py-5">
              <i class="bi bi-devices display-4" style="color: var(--tg-theme-hint-color);"></i>
              <p class="mt-3" style="color: var(--tg-theme-hint-color);">
                Tidak ada perangkat terdaftar
              </p>
            </div>
            @endif
          </div>
        </div>

        <!-- Aktivitas Mencurigakan -->
        @if(count($suspiciousActivities) > 0)
        <div class="row">
          <div class="col-12">
            <div class="card border-0" style="background-color: var(--tg-theme-bg-color);border: 1px solid #dc3545 !important;">
              <div class="card-header" style="background-color: #dc3545;color: white; border-bottom: none;">
                <h6 class="mb-0">
                  <i class="bi bi-exclamation-triangle me-2"></i>
                  Aktivitas Mencurigakan ({{ count($suspiciousActivities) }})
                </h6>
              </div>
              <div class="card-body">
                <div class="alert alert-warning m-3" style="background-color: rgba(255, 193, 7, 0.1);border: 1px solid #ffc107;color: var(--tg-theme-text-color);">
                  <i class="bi bi-exclamation-octagon me-2" style="color: #ffc107;"></i>
                  <strong>Perhatian!</strong> Terdeteksi aktivitas mencurigakan pada akun Anda.
                </div>
                <div class="list-group list-group-flush">
                  @foreach($suspiciousActivities as $activity)
                  <div class="list-group-item" style="background-color: transparent;border-color: var(--tg-theme-hint-color);color: var(--tg-theme-text-color);">
                    <div class="d-flex w-100 justify-content-between">
                      <h6 class="mb-1">{{ ucfirst(str_replace('_', ' ', $activity['type'])) }}</h6>
                      <small style="color: var(--tg-theme-hint-color);">Baru saja</small>
                    </div>
                    <p class="mb-1">
                      {{ $activity['message'] }}
                    </p>
                    @if(isset($activity['count']))
                    <small style="color: var(--tg-theme-hint-color);">Jumlah: {{ $activity['count'] }}</small>
                    @endif
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Fungsi untuk mencabut sesi
  function revokeSession(sessionId) {
    if (confirm('Apakah Anda yakin ingin mencabut sesi ini?')) {
      fetch(`{{ secure_url(config('app.url')) }}/api/authlog/sessions/${sessionId}/revoke`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
      if (data.success) {
      location.reload();
      } else {
      alert('Gagal mencabut sesi: ' + data.message);
      }
      })
      .catch(error => {
      alert('Terjadi kesalahan: ' + error.message);
      });
    }
  }

  // Fungsi untuk mencabut semua sesi lain
  function revokeAllOtherSessions() {
    if (confirm('Apakah Anda yakin ingin mencabut semua sesi lain? Anda akan tetap login di perangkat ini.')) {
      fetch('{{ secure_url(config("app.url")) }}/api/authlog/sessions/revoke-others', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
      if (data.success) {
      alert('Semua sesi lain telah dicabut.');
      location.reload();
      } else {
      alert('Gagal mencabut sesi: ' + data.message);
      }
      }).catch(error =>{
      alert('Terjadi kesalahan: '+ error.message);
      });
    }
  }

  // Fungsi untuk mencabut semua sesi
  function revokeAllSessions() {
    if (confirm('Apakah Anda yakin ingin mencabut semua sesi? Anda akan logout dari semua perangkat.')) {
      fetch('{{ secure_url(config("app.url")) }}/api/authlog/sessions/revoke-all', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
      if (data.success) {
      alert('Semua sesi telah dicabut. Anda akan logout.');
      location.reload();
      } else {
      alert('Gagal mencabut sesi: ' + data.message);
      }
      }).catch(error => {
      alert('Terjad kesalahan: '+ error.message);
      });
    }
  }

  // Fungsi untuk mencabut perangkat
  function revokeDevice(deviceId) {
    if (confirm('Apakah Anda yakin ingin mencabut akses perangkat ini? ID:' + deviceId)) {
      fetch(`{{ secure_url(config('app.url')) }}/api/authlog/devices/${deviceId}/revoke`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
      if (data.success) {
      location.reload();
      } else {
      alert('Gagal mencabut perangkat: ' + data.message);
      }
      }).catch(error => {
      alert('Terjadi kesalahan: '+ error.message);
      });
    }
  }
</script>
@endpush

@push('styles')
<style>
  .stat-card {
    transition: all 0.3s ease;
  }

  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }

  .stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
  }

  .location-info {
    min-width: 200px;
  }

  .country-flag {
    font-size: 1.2em;
  }

  .table > :not(caption) > * > * {
    background-color: transparent !important;
    color: var(--tg-theme-text-color);
    border-bottom-color: var(--tg-theme-hint-color);
  }

  .table-hover tbody tr:hover {
    background-color: rgba(var(--tg-theme-button-color-rgb, 64, 167, 227), 0.05) !important;
  }

  .list-group-item {
    background-color: transparent;
    border-color: var(--tg-theme-hint-color);
    color: var(--tg-theme-text-color);
  }
</style>
@endpush