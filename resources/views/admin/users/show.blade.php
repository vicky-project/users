@extends('coreui::layouts.admin')
@section('title', 'Detail Pengguna')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
  </a>
  <h4 class="mb-0">Detail Pengguna</h4>
  <div></div>
</div>

<div class="row">
  <!-- Informasi Utama -->
  <div class="col-lg-4 mb-4">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-header bg-white border-0 pt-4 pb-0">
        <h5 class="card-title mb-0">
          <i class="bi bi-person-circle me-2 text-primary"></i> Informasi Pengguna
        </h5>
      </div>
      <div class="card-body text-center">
        <img src="{{ $user->avatar }}" class="rounded-circle mb-3" width="120" height="120" alt="Avatar">
        <h5>{{ $user->name }}</h5>
        <p class="text-muted">
          {{ $user->email }}
        </p>
        <div class="d-flex justify-content-center gap-2 mb-3">
          <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
            {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
          @foreach($user->roles as $role)
          <span class="badge bg-info">{{ $role->name }}</span>
          @endforeach
        </div>
        <hr>
        <div class="text-start">
          <p>
            <i class="bi bi-calendar3 me-2"></i> Bergabung: {{ $user->created_at->format('d M Y') }}
          </p>
          <p>
            <i class="bi bi-arrow-repeat me-2"></i> Terakhir update: {{ $user->updated_at->format('d M Y') }}
          </p>
          <p>
            <i class="bi bi-activity me-2"></i> Aktivitas terakhir:
            @if($user->last_activity)
            {{ $user->last_activity->created_at->diffForHumans() }}
            @else
            -
            @endif
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Riwayat Login (Authentication Log) -->
  <div class="col-lg-8 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white border-0 pt-4 pb-0">
        <h5 class="card-title mb-0">
          <i class="bi bi-box-arrow-in-right me-2 text-primary"></i> Riwayat Login
        </h5>
      </div>
      <div class="card-body">
        @if($user->authentications->count())
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Waktu Login</th>
                <th>IP Address</th>
                <th>Perangkat</th>
                <th>Lokasi</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($user->authentications->take(10) as $auth)
              <tr>
                <td class="small">{{ $auth->login_at ? $auth->login_at->format('d/m/Y H:i') : '-' }}</td>
                <td><code>{{ $auth->ip_address }}</code></td>
                <td class="small">{{ $auth->device_name ?? ($auth->user_agent ? Str::limit($auth->user_agent, 40) : '-') }}</td>
                <td class="small">
                  @php
                  $location = is_array($auth->location) ? $auth->location : (json_decode($auth->location, true) ?: []);
                  $city = $location['city'] ?? null;
                  $country = $location['country_name'] ?? $location['country'] ?? null;
                  $locationText = trim(($city ? $city . ', ' : '') . ($country ?? ''));
                  @endphp
                  {{ $locationText ?: '-' }}
                </td>
                <td>
                  @if($auth->login_successful)
                  <span class="badge bg-success">Berhasil</span>
                  @else
                  <span class="badge bg-danger">Gagal</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @if($user->authentications->count() > 10)
          <div class="text-end">
            <a href="{{ route('admin.logs.auth', ['user_id' => $user->id]) }}" class="btn btn-sm btn-link">Lihat semua</a>
          </div>
          @endif
        </div>
        @else
        <p class="text-muted">
          Belum ada riwayat login.
        </p>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Activity Log (Spatie) -->
<div class="row">
  <div class="col-12 mb-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white border-0 pt-4 pb-0">
        <h5 class="card-title mb-0">
          <i class="bi bi-activity me-2 text-primary"></i> Aktivitas Terbaru
        </h5>
      </div>
      <div class="card-body">
        @if($user->activities->count())
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th style="min-width: 140px;">Waktu</th>
                <th>Aksi</th>
                <th>Subject</th>
                <th>Detail</th>
              </tr>
            </thead>
            <tbody>
              @foreach($user->activities->take(20) as $activity)
              <tr>
                <td class="small text-nowrap">{{ $activity->created_at->format('d/m/Y H:i:s') }}</td>
                <td>{{ $activity->description }}</td>
                <td>
                  @if($activity->subject)
                  @if($activity->subject instanceof \Modules\Users\Models\User)
                  {{ $activity->subject->name }}
                  @elseif($activity->subject instanceof \Modules\Telegram\Models\TelegramUser)
                  {{ $activity->subject->first_name }} {{ $activity->subject->last_name }}
                  @else
                  {{ class_basename($activity->subject) }} #{{ $activity->subject->id }}
                  @endif
                  @else
                  -
                  @endif
                </td>
                <td class="small">
                  @if($activity->properties && $activity->properties->count())
                  <pre class="mb-0 text-muted" style="font-size: 0.7rem;">{{ json_encode($activity->properties->toArray(), JSON_PRETTY_PRINT) }}</pre>
                  @else
                  -
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <p class="text-muted">
          Belum ada aktivitas tercatat.
        </p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection