<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Users\AuthLogController;

Route::controller(AuthLogController::class)
->group([
  "middleware" => ["auth", "web"],
  "as" => "authlog.",
  "prefix" => "authlog"
], function () {
  Route::post("device/{deviceId}/revoke", "revokeDevice",
  )->name("device");

  Route::prefix("sessions")
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