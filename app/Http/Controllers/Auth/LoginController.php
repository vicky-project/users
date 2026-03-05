<?php
namespace Modules\Users\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = "/dashboard";

	public function __construct()
	{
		$this->middleware("guest")->except("logout");
		$this->middleware("auth")->only("logout");
	}

	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\View\View
	 */
	public function showLoginForm()
	{
		return view("users::auth.login");
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  mixed  $user
	 * @return mixed
	 */
	protected function authenticated(Request $request, $user)
	{
		$roles = Role::all()->pluck("name");

		if ($roles->has("admin") && $user->hasRole("admin")) {
			return redirect()->route("admin.dashboard");
		}

		return $request->wantsJson()
			? new JsonResponse([], 204)
			: redirect()->intended($this->redirectPath());
	}

	/**
	 * The user has logged out of the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return mixed
	 */
	protected function loggedOut(Request $request)
	{
		//
	}
}
