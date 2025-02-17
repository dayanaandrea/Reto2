<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pagination = getPagination($request);
        // Paginar, para no mostrar todos de golpe
        $schedules = Schedule::orderBy('hour', 'asc')->paginate($pagination);
        return view('admin.schedules.index', ['schedules' => $schedules]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = \App\Models\Module::orderBy('id')->get();
        $users = \App\Models\User::where('role_id', 1)->orderBy('id')->get();

        // Datos que queremos pasar a la vista
        $schedules = Schedule::orderBy('hour')->get();

        return view('admin.schedules.create-edit', [
            'schedules' => $schedules,
            'users' => $users,
            'modules' => $modules,
            'type' => 'POST'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validateSchedule($request);
        // Crear el horario
        $schedule = new Schedule();
        $schedule->module_id = $request->module_id;
        $schedule->day = $request->day;
        $schedule->hour = $request->hour;

        try {
            $schedule->save();
            return redirect()->route('admin.schedules.index')->with('success',   __('schedule.schedules') . '<b>' . $schedule->day . '</b>' .  __('schedule.controller_create'));
        } catch (\Exception $e) {
            return back()->with('error', __('schedule.controller_error_create'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return view('admin.schedules.show', ['schedule' => $schedule]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $modules = \App\Models\Module::orderBy('id')->get();
        $users = \App\Models\User::where('role_id', 1)->orderBy('id')->get();

        //dd($schedule);

        return view('admin.schedules.create-edit', [
            'schedule' => $schedule,
            'users' => $users,
            'modules' => $modules,
            'type' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        // Validar los datos
        $this->validateSchedule($request);

        $schedule->module_id = $request->module_id;
        $schedule->day = $request->day;
        $schedule->hour = $request->hour;

        try {
            $schedule->save();
            return redirect()->route('admin.schedules.index', $schedule)->with('success',  __('schedule.schedules') . '</b>' .  __('schedule.controller_update'));
        } catch (\Exception $e) {
            return back()->with('error', __('schedule.controller_error_create'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {

        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', __('schedule.controller_delete'));
    }

    /**
     * Validates module's data.
     */
    private function validateSchedule(Request $request)
    {
        $request->validate([

            'module_id' => 'required',
            'day' => 'required|numeric|min:1|max:5',
            'hour' => 'required|numeric|min:1|max:6',
        ], [
            'module_id.required' => __('schedule.module_id_required'),
            'day.required' => __('schedule.day_required'),
            'hour.required' => __('schedule.hour_required'),
        ]);
    }
}
