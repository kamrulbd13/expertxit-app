<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('backend.user_management.permission_role.index', compact('roles'));
    }

    // Create - show form
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.user_management.permission_role.create', compact('roles', 'permissions'));
    }

    // Store - assign permissions to role
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_ids' => 'required|array'
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->permissions()->sync($request->permission_ids);

        return redirect()->route('permission-role.index')->with('success', 'Permissions assigned successfully.');
    }

    // Edit - show edit form
    public function edit($role_id)
    {
        $role = Role::with('permissions')->findOrFail($role_id);
        $permissions = Permission::all();
        return view('backend.user_management.permission_role.edit', compact('role', 'permissions'));
    }

    // Update - update permissions
    public function update(Request $request, $role_id)
    {
        $request->validate([
            'permission_ids' => 'required|array'
        ]);

        $role = Role::findOrFail($role_id);
        $role->permissions()->sync($request->permission_ids);

        return redirect()->route('permission-role.index')->with('success', 'Permissions updated successfully.');
    }

    // Destroy - remove all permissions from role
    public function destroy($role_id)
    {
        $role = Role::findOrFail($role_id);
        $role->permissions()->detach();

        return redirect()->route('permission-role.index')->with('delete', 'Permissions removed successfully.');
    }

}
