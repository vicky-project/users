<?php

namespace Modules\Users\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return view("users::admin.index");
	}
}
