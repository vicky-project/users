<?php
namespace Modules\Users\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Rappasoft\LaravelAuthenticationLog\Helpers\DeviceFingerprint;

class AuthLogController extends Controller {
  /**
  * Store a newly created resource in storage.
  */
  public function statistics(Request $request, User $user) {
    // Detect suspicious activity
    $suspiciousActivities = $user->detectSuspiciousActivity();
    $stats = $user->getLoginStats();
    // Get all active sessions
    $activeSessions = $user->getActiveSessions();
    $sessionsCount = $user->getActiveSessionsCount();
    // Get all user devices
    $devices = $user->getDevices();

    return view(
      "users::profile.statistics",
      compact(
        "suspiciousActivities",
        "stats",
        "activeSessions",
        "sessionsCount",
        "devices",
      ),
    );
  }

  /**
  * Show the specified resource.
  */
  public function trustedDeviceToggle(Request $request) {
    $request->validate([
      "device_id" =>
      "required|string|exists:" .
      config("authentication-log.table_name") .
      ",device_id",
    ]);

    try {
      $deviceId = $request->device_id;
      $user = $request->user();
      $cacheKey = "device_user_" . $user->id . "_trusted_" . md5($deviceId);

      $isTrusted = cache()->has($cacheKey)
      ? cache()->get($cacheKey)
      : $user->isDeviceTrusted($deviceId);

      if ($isTrusted) {
        $user->untrustDevice($deviceId);
        $message = "Success untrust device";
      } else {
        $user->trustDevice($deviceId);
        $message = "Success trust device";
      }

      cache()->forget($cacheKey);

      return response()->json(["success" => true, "message" => $message]);
    } catch (\Exception $e) {
      \Log::error("Failed to toggle trusted device.", [
        "message" => $e->getMessage(),
        "trace" => $e->getTraceAsString(),
        "request" => $request->all(),
      ]);
      return response()->json(
        [
          "success" => false,
          "message" => $e->getMessage(),
        ],
        500,
      );
    }
  }

  /**
  * Update the specified resource in storage.
  */
  public function revokeOtherSessions(Request $request) {
    try {
      $user = $request->user();
      $currentDeviceId = DeviceFingerprint::generate($request);

      $user->revokeAllOtherSessions($currentDeviceId);

      cache()->flush();

      return response()->json([
        "success" => true,
      ]);
    } catch (\Exception $e) {
      \Log::error("Failed to revoke all other sessions", [
        "message" => $e->getMessage(),
        "trace" => $e->getTraceAsString(),
      ]);

      return response()->json(
        [
          "success" => false,
          "message" => $e->getMessage(),
        ],
        500,
      );
    }
  }

  /**
  * Remove the specified resource from storage.
  */
  public function revokeSession(Request $request, $sessionId) {
    try {
      $user = $request->user();
      $user->revokeSession($sessionId);

      cache()->flush();

      return response()->json(["success" => true]);
    } catch (\Exception $e) {
      \Log::error("Failed to revoke session with ID: " . $sessionId, [
        "message" => $e->getMessage(),
        "trace" => $e->getTraceAsString(),
      ]);

      return response()->json(
        ["success" => false, "message" => $e->getMessage()],
        500,
      );
    }
  }

  public function revokeAllSessions(Request $request) {
    try {
      $user = $request->user();
      $user->revokeAllSessions();

      cache()->flush();

      return response()->json(["success" => true]);
    } catch (\Exception $e) {
      \Log::error("Failed to revoke all sessions", [
        "message" => $e->getMessage(),
        "trace" => $e->getTraceAsString(),
      ]);

      return response()->json(
        ["success" => false, "message" => $e->getMessage()],
        500,
      );
    }
  }

  public function revokeDevice(Request $request, $deviceId) {
    $user = $request->user();
    abort_if(!$user, 401, "Unauthenticated");

    try {
      $authLog = $user
      ->authentications()
      ->where("device_id", $deviceId)
      ->delete();

      cache()->flush();

      return response()->json([
        "success" => true,
        "message" => "Device revoke successfuly.",
      ]);
    } catch (\Exception $e) {
      \Log::error("Failed to revoke device with ID: " . $deviceId, [
        "message" => $e->getMessage(),
        "trace" => $e->getTraceAsString(),
      ]);

      return response()->json(
        ["success" => false, "message" => $e->getMessage()],
        500,
      );
    }
  }
}