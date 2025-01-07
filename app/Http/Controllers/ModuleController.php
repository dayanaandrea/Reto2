<?php

namespace App\Http\Controllers;

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
        return view('admin.module.index',['modules' => $modules]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::orderBy('code')->get();
        return view('admin.module.create', ['modules'=>$modules]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear el usuario
        $modules = new Module();
        $modules->code = $request->code;
        $modules->name = $request->name;
        $modules->hours = $request->hours;
        $modules->course = $request->course;
        $modules->cycle_id = $request->cycle_id;

        // Guardar el nuevo usuario
        $modules->save();

        return redirect()->route('admin.modules.index')->with('success', 'Modulo  ' . $modules->name . ' creado correctamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('admin.module.show',['module'=>$module]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $name = $module->name; 
        $module->delete(); 
        return view('admin.module.success', ['name'=>$name]); 
        //return redirect()->route('admin.module.index')->with('success', 'Usuario ' . $user->email . ' eliminado correctamente.');
            
    }
}
