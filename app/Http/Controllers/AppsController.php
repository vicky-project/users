<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppsController extends Controller
{
  /**
  * Display a listing of the resource.
  */
  public function index() {
    return view('users::index');
  }

  /**
  * Show the form for creating a new resource.
  */
  public function profile() {
    $user = auth()->user();
    return view('users::profile.index', compact('user'));
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request) {}

  /**
  * Show the specified resource.
  */
  public function show() {
    return view('users::show');
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