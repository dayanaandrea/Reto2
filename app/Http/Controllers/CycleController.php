<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use Illuminate\Http\Request;

class CycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cycles = Cycle::orderBy('name', 'desc')->paginate(10);
        return view('admin.cycles.index',['cycles' => $cycles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cycles.create-edit', ['type'=>'POST']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $this->validateCycle($request);

        // Crear el ciclo
        $cycles = new Cycle();
        $cycles->code = strtoupper($request->code);
        $cycles->name = $request->name;

        // Guardar el nuevo ciclo
        $cycles->save();

        return redirect()->route('admin.cycles.index')->with('success',  __('cycle.cycle') . '<b>' . $cycles->name . '</b>'.   __('cycle.controller_create'));

    
    }

    /**
     * Display the specified resource.
     */
    public function show(Cycle $cycle)
    {
        return view('admin.cycles.show',['cycle'=>$cycle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cycle $cycle)
    {
        // Aqui se le pueden mandar los datos de los modulos para el combo 
        return view('admin.cycles.create-edit', ['cycle'=>$cycle, 'type'=>'PUT']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cycle $cycle)
    {
       // Validar los datos
       $this->validateCycle($request);

       $cycle->code = strtoupper($request->code);
       $cycle->name = $request->name;

       // Guardar el nuevo ciclo
       $cycle->save();

       return redirect()->route('admin.cycles.index', $cycle)->with('success',   __('cycle.cycle') . '<b>' . $cycle->cycle . '</b>'.   __('cycle.controller_edit'));
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cycle $cycle)
    {
        $cycle->delete(); 
        return redirect()->route('admin.cycles.index')->with('success',   __('cycle.cycle') . '<b>' . $cycle->name . '</b>'.   __('cycle.controller_delete'));
    }
    /**
     * Validates cycle's data.
     */
    private function validateCycle(Request $request)
    {
        $request->validate([
            'code' => 'required|min:3|max:5',
            'name' => 'required|string|min:10|max:255',
        ], [
            // Mensajes de error personalizados según lo que falle
            'code.min' => __('cycle.validation_code_min'),
            'code.max' => __('cycle.validation_code_max'),
            'name.min' => __('cycle.validation_name_min'),
            'name.max' => __('cycle.validation_name_max'),
        ]);
    }
}

