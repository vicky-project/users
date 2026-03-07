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
            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?s=200&d=mp"
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

@endsection