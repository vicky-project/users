<?php
namespace Modules\Users\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
	use SendsPasswordResetEmails;

	/**
	 * Display the form to request a password reset link.
	 *
	 * @return \Illuminate\View\View
	 */
	public function showLinkRequestForm()
	{
		return view("users::auth.passwords.email");
	}
}
