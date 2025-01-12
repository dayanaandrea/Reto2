<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Module;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::orderBy('cycle_id', 'desc')   
        ->orderBy('course', 'asc')     
        ->paginate(10);               
        return view('admin.modules.index', ['modules' => $modules]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Datos que queremos pasar a la vista
        $cycles = Cycle::orderBy('code')->get();

        // Esto es para poder cargar los datos de el usuario que tenga el rol 'profesor'
        $profesorRole = Role::where('role', 'profesor')->first();
        $users = User::where('role_id', $profesorRole->id)->orderBy('name')->get();

        return view('admin.modules.create-edit', ['type' => 'POST', 'cycles' => $cycles, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $this->validateModule($request);

        // Crear el modulo
        $module = new Module();
        $module->code = strtoupper($request->code);
        $module->name = $request->name;
        $module->hours = $request->hours;
        $module->course = $request->course;
        $module->cycle_id = $request->cycle_id;
        $module->user_id = $request->user_id;
        // Guardar el nuevo modulo
        $module->save();

        return redirect()->route('admin.modules.index')->with('success', 'Modulo  ' . $module->name . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('admin.modules.show', ['module' => $module]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        $cycles = Cycle::orderBy('code')->get();
         // Esto es para poder cargar los datos de el usuario que tenga el rol 'profesor'
         $profesorRole = Role::where('role', 'profesor')->first();
         $users = User::where('role_id', $profesorRole->id)->orderBy('name')->get();

        return view('admin.modules.create-edit', ['module' => $module, 'type' => 'PUT', 'cycles' => $cycles, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        // Validar los datos
        $this->validateModule($request);

        $module->code = strtoupper($request->code);
        $module->name = $request->name;
        $module->hours = $request->hours;
        $module->course = $request->course;
        $module->cycle_id = $request->cycle_id;
        $module->user_id = $request->user_id;

        // Guardar el nuevo modulo
        $module->save();

        return redirect()->route('admin.modules.index', $module)->with('success', 'Modulo <b>' . $module->name . '</b> actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('admin.modules.index')->with('success', 'Modulo  <b>' . $module->name . '</b> eliminado correctamente.');
    }
    /**
     * Validates module's data.
     */
    private function validateModule(Request $request)
    {
        $request->validate([
           
            'code' => 'required|min:3|max:5',
            'name' => 'required|string|min:10|max:255',
            'hours' => 'required|integer',
            'course' => 'required|in:1,2', 
            'cycle_id' => 'required',
        ], [
            'code.required' => 'El campo de código es obligatorio.',
            'code.min' => 'El código debe tener al menos 3 caracteres.',
            'code.max' => 'El código no puede tener más de 5 caracteres.',
            'name.required' => 'El campo de nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 10 caracteres.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'hours.required' => 'El campo de horas es obligatorio.',
            'hours.numeric' => 'Ingrese un número válido para las horas.',
            'course.in' => 'El curso solo puede ser 1 o 2.',
            'course.required' => 'El campo de curso es obligatorio.',
            'cycle_id.required' => 'El campo de ciclo es obligatorio.',
        ]);
    }
}
