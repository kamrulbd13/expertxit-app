<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('backend.user_management.user_roles.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('backend.user_management.user_roles.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->roles()->syncWithoutDetaching([$request->role_id]);

        return redirect()->route('user-roles.index')->with('success', 'Role assigned successfully.');
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('backend.user_management.user_roles.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.user_management.user_roles.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_ids' => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->roles()->sync($request->role_ids);

        return redirect()->route('user-roles.index')->with('success', 'Roles updated successfully.');
    }

    public function destroy($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach($request->role_id);

        return redirect()->route('user-roles.index')->with('delete', 'Role removed successfully.');
    }
}
