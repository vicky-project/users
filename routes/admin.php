<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Admin\DashboardController;
use Modules\Users\Http\Controllers\Admin\PermissionController;
use Modules\Users\Http\Controllers\Admin\RoleController;
use Modules\Users\Http\Controllers\Admin\UserController;

Route::group(
	["prefix" => "admin", "middleware" => "auth", "as" => "admin."],
	function () {
		Route::get("dashboard", [DashboardController::class, "index"])->name(
			"dashboard",
		);

		// Users
		Route::get("users/{user}/assign-roles", [
			UserController::class,
			"assignRoles",
		])->name("assign-roles");
		Route::post("users/{user}/assign-roles", [
			UserController::class,
			"updateRoles",
		])->name("assign-roles.update");
		Route::resource("users", UserController::class);

		// Roles
		Route::get('roles/{role}/assign-permissions',[RoleController::class,'assignPermissions'])->name('assign-permissions');
		Route::post('roles/{role}/assign-permissions',[RoleController::class,'updatePermissions'])->name('assign-permissions.update');
		Route::resource("roles", RoleController::class);

		// Permissions
		Route::resource("permissions", PermissionController::class);
	},
);
