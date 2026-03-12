<?php
namespace Modules\Users\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SelectAuthGuard
{
  public function handle(Request $request, Closure $next) {
    // Cek apakah ada token (bearer token atau query parameter 'token')
    $token = $request->bearerToken() ?? $request->get('token');

    if ($token) {
      // Jika ada token, set default guard ke 'sanctum'
      config(['auth.defaults.guard' => 'sanctum']);
    } else {
      // Jika tidak, set default guard ke 'web'
      config(['auth.defaults.guard' => 'web']);
    }

    return $next($request);
  }
}