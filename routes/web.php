<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\ForgotPasswordController;
use Modules\Users\Http\Controllers\Auth\LoginController;
use Modules\Users\Http\Controllers\Auth\RegisterController;
use Modules\Users\Http\Controllers\Auth\ResetPasswordController;
use Modules\Users\Http\Controllers\UsersController;

// Authentication Routes
Route::group(["middleware" => "web"], function () {
	// Login
	Route::get("login", [LoginController::class, "showLoginForm"])->name("login");
	Route::post("login", [LoginController::class, "login"]);
	Route::post("logout", [LoginController::class, "logout"])->name("logout");

	// Register
	Route::get("register", [
		RegisterController::class,
		"showRegistrationForm",
	])->name("register");
	Route::post("register", [RegisterController::class, "register"]);

	// Forgot Password
	Route::get("password/reset", [
		ForgotPasswordController::class,
		"showLinkRequestForm",
	])->name("password.request");
	Route::post("password/email", [
		ForgotPasswordController::class,
		"sendResetLinkEmail",
	])->name("password.email");

	// Reset Password
	Route::get("password/reset/{token}", [
		ResetPasswordController::class,
		"showResetForm",
	])->name("password.reset");
	Route::post("password/reset", [
		ResetPasswordController::class,
		"reset",
	])->name("password.update");
});

Route::group(['middleware'=>'auth'], function(){
  Route::get('/dashboard',[UsersController::class,'index'])->name('dashboard');
  Route::get('/profile',[UsersController::class,'profile'])->name('profile');
  Route::get('/profile/edit',[UsersController::class,'edit'])->name('profile.edit');
  Route::put('/profile',[UsersController::class,'update'])->name('profile.update');
});
