<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::orderBy('course', 'asc')->paginate(10);
        return view('admin.module.index', ['modules' => $modules]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Datos que queremos pasar a la vista
        $cycles = Cycle::orderBy('id')->get();
        return view('admin.module.create-edit',['type'=>'POST', 'cycles' => $cycles]);
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
        // Guardar el nuevo usuario
        $module->save();

        return redirect()->route('admin.modules.index')->with('success', 'Modulo  ' . $module->name . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('admin.module.show', ['module' => $module]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return view('admin.module.create-edit', ['module' => $module, 'type'=>'PUT']);
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
            'hours' => 'required',
            'course' => 'required|in:1,2', // Solo permite que sea 1 o 2
            'cycle_id' => 'required',
        ], [
            // Mensajes de error personalizados según lo que falle
            'code.min' => 'El código debe tener al menos 3 caracteres.',
            'code.max' => 'El código no puede tener más de 5 caracteres.',
            'name.min' => 'El nombre debe tener al menos 10 caracteres.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'hours.min' => 'El nombre debe tener al menos 10 caracteres.',
            'hours.max' => 'El nombre no puede tener más de 255 caracteres.',
            'course.in' => 'El cuso solo puede ser 1 o 2 .',
            'course.max' => 'El nombre no puede tener más de 255 caracteres.',
            'cycle_id.min' => 'El nombre debe tener al menos 10 caracteres.',
           
        ]);
    }
}
