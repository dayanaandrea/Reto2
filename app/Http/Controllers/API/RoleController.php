<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('created_at')->get();
        return response()->json(['roles' => $roles], Response::HTTP_OK);
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

        // Guardar el nuevo rol
        $role->save();

        return response()->json(['role' => $role], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json(['role' => $role], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        validateRole($request);

        $role->role = strtolower($request->role);
        $role->description = $request->description;

        // Guardar el nuevo rol
        $role->save();

        return response()->json(['role' => $role], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

