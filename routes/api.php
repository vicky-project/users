<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Users\AuthLogController;

Route::group([
  "middleware" => ["web", "auth"],
  "prefix" => "authlog",
  "as" => "authlog."
], function () {
  Route::post("devices/{deviceId}/revoke", [AuthLogController::class, "revokeDevice"]
  )->name("device");

  Route::controller(AuthLogController::class)
  ->prefix("sessions")
  ->name("sessions.")
  ->group(function () {
    Route::post("/revoke-others", "revokeOtherSessions",
    )->name("revoke-others");

    Route::post("/revoke-all", "revokeAllSessions",
    )->name("revokeAll");

    Route::post("/{sessionId}/revoke", "revokeSession",
    )->name("revoke");
  });
});