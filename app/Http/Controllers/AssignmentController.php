<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::orderBy('id', 'asc')->paginate(10);
        return view('admin.assignments.index',['assignments' => $assignments]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //where('role_id',2) is used to get only teachers
        $users = \App\Models\User::where('role_id',2)->orderBy('id')->get();
        $modules = \App\Models\Module::orderBy('id')->get();

        return view('admin.assignments.create-edit', [
            'users' => $users,
            'modules' => $modules,
            'type'=>'POST']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user' => 'required|exists:users,id',  // Suponiendo que 'user' es el ID de usuario
            'module' => 'required|exists:modules,id',  // Suponiendo que 'module' es el ID del módulo
        ]);

        // Crear la asignación
        Assignment::create([
            'user_id' => $request->user,
            'module_id' => $request->module,
        ]);

        // Redirigir a la lista de asignaciones
        return redirect()->route('admin.assignments.index')->with('success', 'Asignación creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        return view('admin.assignments.show',['assignment'=>$assignment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        //where('role_id',2) is used to get only teachers
        $users = \App\Models\User::where('role_id',2)->orderBy('id')->get();
        $modules = \App\Models\Module::orderBy('id')->get();

        return view('admin.assignments.create-edit', [
            'assignment'=>$assignment,
            'users' => $users,
            'modules' => $modules,
            'type'=>'PUT']);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        // Validación de los datos del formulario (puedes agregar reglas de validación aquí)
        $validated = $request->validate([
            'user' => 'required|exists:users,id',  // Suponiendo que 'user' es el ID de usuario
            'module' => 'required|exists:modules,id',  // Suponiendo que 'module' es el ID del módulo
        ]);

        // Actualizar la asignación
        $assignment->update([
            'user_id' => $request->user,
            'module_id' => $request->module,
        ]);

        // Redirigir a la lista de asignaciones
        return redirect()->route('admin.assignments.index')->with('success', 'Asignación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}