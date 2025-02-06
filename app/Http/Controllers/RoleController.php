<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount('users')->orderBy('role', 'asc')->paginate(config('app.pagination', 10));
        // Contar usuarios sin rol
        $sin_roles = User::whereNull('role_id')->count();
        return view('admin.roles.index', ['roles' => $roles, 'sin_roles' => $sin_roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create-edit', ['type' => 'POST']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        validateRole($request);

        // Crear el rol
        $role = new Role();
        $role->role = strtolower($request->role);
        $role->description = $request->description;

        try {
            // Guardar el nuevo rol
            $role->save();
            return redirect()->route('admin.roles.index')->with('success',   __('role.controller_rol') . '<b>' . $role->role . '</b>' . __('role.controller_create'));
        } catch (\Exception $e) {
            return back()->with('error',  __('role.controller_error_create'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        // Contar los usuarios con el rol
        $userCount = $role->users()->count();

        return view('admin.roles.show', [
            'role' => $role,
            'userCount' => $userCount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.create-edit', ['role' => $role, 'type' => 'PUT']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if ($role->role == 'god' || $role->role == 'administrador' || $role->role == 'estudiante' || $role->role == 'profesor') {
            return back()->with('permission', __('role.controller_rol') . '<b>'  . $role->role . '</b>' . __('role.controller_update_2'));
        }
        // Validar los datos
        validateRole($request);

        $role->role = strtolower($request->role);
        $role->description = $request->description;

        try {
            // Guardar el nuevo rol
            $role->save();
            return redirect()->route('admin.roles.show', $role)->with('success',  __('role.controller_rol') . '<b>'  . $role->role . '</b>' . __('role.controller_update'));
        } catch (\Exception $e) {
            return back()->with('error',  __('role.controller_error_update') . '<b>'  . $role->role . '</b>.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->role == 'god' || $role->role == 'administrador' || $role->role == 'estudiante' || $role->role == 'profesor') {
            return back()->with('permission',  __('role.controller_rol') . '<b>'  . $role->role . '</b>' . __('role.controller_delete_2'));
        } else {
            $role->delete();
            return redirect()->route('admin.roles.index')->with('success',  __('role.controller_rol') . '<b>'  . $role->role . '</b>' . __('role.controller_delete'));
        }
    }
}
