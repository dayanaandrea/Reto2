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
        return view('admin.cycle.index',['cycles' => $cycles]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cycles = Cycle::orderBy('code')->get();
        return view('admin.cycle.create', ['cycles'=>$cycles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                // Crear el ciclo
                $cycles = new Cycle();
                $cycles->code = $request->code;
                $cycles->name = $request->name;
        
                // Guardar el nuevo ciclo
                $cycles->save();
        
                return redirect()->route('admin.cycles.index')->with('success', 'Ciclo  ' . $cycles->name . ' creado correctamente.');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Cycle $cycle)
    {
        return view('admin.cycle.show',['cycle'=>$cycle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cycle $cycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cycle $cycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cycle $cycle)
    {
        //
    }
}
