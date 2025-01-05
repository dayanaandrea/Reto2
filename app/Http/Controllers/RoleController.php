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
        $roles = Role::withCount('users')->orderBy('role', 'asc')->paginate(5);
        // Contar usuarios sin rol
        $sin_roles = User::whereNull('role_id')->count();
        return view('admin.roles.index', ['roles' => $roles, 'sin_roles' => $sin_roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear el rol
        $role = new Role();
        $role->role = $request->role;
        $role->description = $request->description;

        // Guardar el nuevo rol
        $role->save();

        return redirect()->route('admin.roles.index')->with('success', 'Rol ' . $role->role . ' creado correctamente.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->role == 'god' || $role->role == 'administrador' || $role->role == 'estudiante' || $role->role == 'profesor') {
            return redirect()->route('admin.roles.index')->with('permission', 'El rol ' . $role->role . ' no puede ser eliminado.');
        } else {
            $role->delete();
            return redirect()->route('admin.roles.index')->with('success', 'Rol ' . $role->role . ' eliminado correctamente.');
        }
    }
}
