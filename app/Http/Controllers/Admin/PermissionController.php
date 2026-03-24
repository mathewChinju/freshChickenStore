<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('permission:permission-list')->only('index');
        $this->middleware('permission:permission-create')->only('create', 'store');
        $this->middleware('permission:permission-edit')->only('edit', 'update');
        $this->middleware('permission:permission-delete')->only('destroy');
    }

    public function index()
    {
        $permissions = Permission::with('roles')->withCount('roles')->latest()->paginate(10);
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('admin.permissions.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name'
        ]);

        $permission = Permission::create(['name' => $request->name]);

        if ($request->has('roles')) {
            $permission->syncRoles($request->roles);
        }

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::orderBy('name')->get();
        $permissionRoles = $permission->roles->pluck('name')->toArray();
        
        return view('admin.permissions.edit', compact('permission', 'roles', 'permissionRoles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')->ignore($permission->id)
            ],
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name'
        ]);

        $permission->update(['name' => $request->name]);

        if ($request->has('roles')) {
            $permission->syncRoles($request->roles);
        } else {
            $permission->syncRoles([]);
        }

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        // Prevent deletion if permission is assigned to roles
        // if ($permission->roles()->count() > 0) {
        //     return redirect()->back()
        //         ->with('error', 'Cannot delete permission while it is assigned to roles. Please remove from roles first.');
        // }

        $permission->syncRoles([]); // Removes all role associations

        $permission->delete();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
