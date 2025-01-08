<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

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
    
        return view('admin.cycle.create-edit', ['type'=>'POST']);
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

        return redirect()->route('admin.cycles.index')->with('success', 'Ciclo   <b>' . $cycles->name . '</b> creado correctamente.');
    
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
        // Aqui se le pueden mandar los datos de los modulos para el combo 
        return view('admin.cycle.create-edit', ['cycle'=>$cycle, 'type'=>'PUT']);
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

       return redirect()->route('admin.cycles.show', $cycle)->with('success', 'Ciclo <b>' . $cycle->cycle . '</b> actualizado correctamente.');
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cycle $cycle)
    {
      
        $cycle->delete(); 
        return redirect()->route('admin.cycles.index')->with('success', 'Ciclo  <b>' . $cycle->name . '</b> eliminado correctamente.');
       
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
            'code.min' => 'El código debe tener al menos 3 caracteres.',
            'code.max' => 'El código no puede tener más de 5 caracteres.',
            'name.min' => 'El nombre debe tener al menos 10 caracteres.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
        ]);
    }
}

