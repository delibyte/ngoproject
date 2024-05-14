<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('role.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view ('role.edit', [
            'role' => $role,
            'users' => $role->users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        $attributes = $request->validate([
            'user_id' => 'required', 'integer', 'exists:users,id',
        ]);

        $user = User::where('id', $attributes['user_id'])->first();
        $user->roles()->detach($role->id);

        return redirect()->route('roles.edit', ['role' => $role])->with('success',  'Role ' . $role->name . ' removed from user ' . $user->name);
    }
}
