<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Users\AuthLogController;

Route::middleware(["auth", "web"])
->prefix("authlog")
->name("authlog.")
->group(function () {
  Route::post("device/{deviceId}/revoke", [AuthLogController::class, "revokeDevice"]
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