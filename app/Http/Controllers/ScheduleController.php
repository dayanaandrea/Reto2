<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Paginar, para no mostrar todos de golpe
        $schedules = Schedule::orderBy('hour', 'asc')->paginate(10);
        return view('admin.schedules.index',['schedules' => $schedules]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schedules.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Crear el horario
        $schedule = new Schedule();
        $schedule->user_id = $request->user_id;
        $schedule->module_id = $request->module_id;
        $schedule->day = $request->day;
        $schedule->hour = $request->hour;

        dd($request);
        // Guardar el nuevo horario
        $schedule->save();

        return redirect()->route('admin.schedules.index')->with('success', 'Horario  ' . $schedule->day . ' creado correctamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return view('admin.schedules.show',['schedule'=>$schedule]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {

        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Horario eliminado correctamente.');
    }
}