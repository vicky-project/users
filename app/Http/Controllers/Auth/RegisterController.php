<?php
namespace Modules\Users\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Modules\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
  use RegistersUsers;

  /**
  * Where to redirect users after registration.
  *
  * @var string
  */
  protected $redirectTo = "/apps/dashboard";

  /**
  * Show the application registration form.
  *
  * @return \Illuminate\View\View
  */
  public function showRegistrationForm() {
    return view("users::auth.register");
  }

  /**
  * The user has been registered.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  mixed  $user
  * @return mixed
  */
  protected function registered(Request $request, $user) {
    $roles = Role::all()->pluck("name");

    if ($roles->has("user")) {
      $user->assignRole("user");
    }

    return $request->wantsJson()
    ? new JsonResponse([], 204)
    : redirect()->intended($this->redirectPath());
  }

  /**
  * Get a validator for an incoming registration request.
  *
  * @param  array  $data
  * @return \Illuminate\Contracts\Validation\Validator
  */
  protected function validator(array $data) {
    return Validator::make($data, [
      "name" => "required|string|max:255",
      "email" => "required|string|max:255|unique:users",
      "password" => "required|string|min:8|confirmed",
    ]);
  }

  /**
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return \App\Models\User
  */
  protected function create(array $data) {
    return User::create([
      "name" => $data["name"],
      "email" => $data["email"],
      "password" => Hash::make($data["password"]),
    ]);
  }
}