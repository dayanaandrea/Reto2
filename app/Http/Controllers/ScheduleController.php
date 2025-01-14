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
        $modules = \App\Models\Module::orderBy('id')->get();
        $users = \App\Models\User::where('role_id',1)->orderBy('id')->get();

         // Datos que queremos pasar a la vista
         $schedules = Schedule::orderBy('hour')->get();

         return view('admin.schedules.create-edit', [
            'schedules' => $schedules,
            'users' => $users,
            'modules' => $modules,
            'type'=>'POST']);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Crear el horario
        $schedule = new Schedule();
        //$schedule->user_id = $request->user_id;
        $schedule->module_id = $request->module_id;
        $schedule->day = $request->day;
        $schedule->hour = $request->hour;

        //dd($request);
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
        $modules = \App\Models\Module::orderBy('id')->get();
        $users = \App\Models\User::where('role_id',1)->orderBy('id')->get();

         //dd($schedule);

         return view('admin.schedules.create-edit', [
            'schedule' => $schedule,
            'users' => $users,
            'modules' => $modules,
            'type'=>'PUT']);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
         // Validar los datos
         $this->validateSchedule($request);

         //$schedule->schedule = strtolower($request->schedule);
         //dd($request);
         $schedule->module_id = $request->module_id;
         $schedule->day = $request->day;
         $schedule->hour = $request->hour;
         // Guardar el nuevo horario
         $schedule->save();
 
         return redirect()->route('admin.schedules.index', $schedule)->with('success', 'Horario <b>' . $schedule->day . '</b> actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {

        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Horario eliminado correctamente.');
    }

    /**
     * Validates module's data.
     */
    private function validateSchedule(Request $request)
    {
        $request->validate([
           
            'module_id' => 'required',
            'day' => 'required',
            'hour' => 'required',
        ], [
            'module_id.required' => 'El campo de módulo es obligatorio.',
            'day.required' => 'El campo día es obligatorio.',
            'hour.required' => 'El campo de horas es obligatorio.',
        ]);
    }
}