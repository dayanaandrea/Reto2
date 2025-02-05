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
    public function index(Request $request)
    {
        $pagination = getPagination($request);
        $modules = Module::orderBy('cycle_id', 'desc')
            ->orderBy('course', 'asc')
            ->paginate($pagination);
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
        
        
        try {
            $module->save();
            return redirect()->route('admin.modules.index')->with('success', 'Módulo  ' . $module->name . ' creado correctamente.');    
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear el modulo.');
        }
    
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

        try {
            $module->save();
            return redirect()->route('admin.modules.index', $module)->with('success', 'Modulo <b>' . $module->name . '</b> actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al modificar el modulo.');
        }
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

            'code' => 'required|min:2|max:6',
            'name' => 'required|string|min:5|max:255',
            'hours' => 'required|integer',
            'course' => 'required|in:0,1,2',
            'cycle_id' => 'required',
        ], [
            'code.required' => __('module.code_required'),
            'code.min' => __('module.code_min'),
            'code.max' => __('module.code_max'),
            'name.required' => __('module.name_required'),
            'name.min' => __('module.name_min'),
            'name.max' => __('module.name_max'),
            'hours.required' => __('module.hours_required'),
            'hours.numeric' => __('module.hours_numeric'),
            'course.in' => __('module.course_in'),
            'course.required' => __('module.course_required'),
            'cycle_id.required' => __('module.cycle_id_required'),
        ]);
    }
}
