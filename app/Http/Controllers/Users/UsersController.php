<?php

namespace Modules\Users\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Facades\Hash;
use Rappasoft\LaravelAuthenticationLog\Helpers\DeviceFingerprint;

class UsersController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index(Request $request) {
    $device = DeviceFingerprint::generate($request);
    $user = $request->user();
    $cacheKey = "device_user_" . $user->id . "_trusted_" . md5($device);
    $isTrusted = cache()->remember(
      $cacheKey,
      now()->addHours(),
      fn() => $user->isDeviceTrusted($device),
    );
    return view('users::index', compact("isTrusted", "user", "device"));
  }

  /**
  * Show the form for creating a new resource.
  */
  public function profile() {
    $user = auth()->user();
    return view('users::profile.index', compact('user'));
  }

  /**
  * Show the form for editing the specified resource.
  */
  public function edit() {
    $user = auth()->user();
    return view('users::profile.edit', compact('user'));
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request) {
    $user = auth()->user();
    $data = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name = $data['name'];
    $user->email = $data['email'];
    if (!empty($data['password'])) {
      $user->password = Hash::make($data['password']);
    }
    $user->save();

    return redirect()->route('profile')->with('success', 'Profile updated successfully.');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy($id) {}
}