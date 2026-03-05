<?php
namespace Modules\Users\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
	public function index()
	{
		$users = User::with("roles")->paginate(10);
		return view("users::admin.users.index", compact("users"));
	}

	public function create()
	{
		$roles = Role::all();
		return view("users::admin.users.create", compact("roles"));
	}

	public function store(Request $request)
	{
		$data = $request->validate([
			"name" => "required|string|max:255",
			"email" => "required|email|unique:users",
			"password" => "required|string|min:8",
			"roles" => "array",
		]);

		$user = User::create([
			"name" => $data["name"],
			"email" => $data["email"],
			"password" => bcrypt($data["password"]),
		]);

		if (isset($data["roles"])) {
			$user->syncRoles($data["roles"]);
		}

		return redirect()
			->route("admin.users.index")
			->with("success", "User created successfully.");
	}

	public function edit(User $user)
	{
		$roles = Role::all();
		$userRoles = $user->roles->pluck("id")->toArray();
		return view(
			"users::admin.users.edit",
			compact("user", "roles", "userRoles"),
		);
	}

	public function update(Request $request, User $user)
	{
		$data = $request->validate([
			"name" => "required|string|max:255",
			"email" => "required|email|unique:users,email," . $user->id,
			"password" => "nullable|string|min:8",
			"roles" => "array",
		]);

		$user->update([
			"name" => $data["name"],
			"email" => $data["email"],
			"password" => isset($data["password"])
				? bcrypt($data["password"])
				: $user->password,
		]);

		$user->syncRoles($data["roles"] ?? []);

		return redirect()
			->route("admin.users.index")
			->with("success", "User updated successfully.");
	}

	public function destroy(User $user)
	{
		$user->delete();
		return redirect()
			->route("admin.users.index")
			->with("success", "User deleted successfully.");
	}

	public function assignRoles(Request $request, User $user)
	{
		$roles = Role::all();
		$userRoles = $user->roles->pluck("id")->toArray();
		return view(
			"users::admin.users.assign-roles",
			compact("user", "roles", "userRoles"),
		);
	}

	public function updateRoles(Request $request, User $user)
	{
		$request->validate(["roles" => "array"]);
		$user->syncRoles($request->roles ?? []);
		return redirect()
			->route("admin.users.index")
			->with("success", "Roles assigned successfully.");
	}
}
