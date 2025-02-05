<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', null);
        $meetingsQuery = Meeting::query();

        if ($status) {
            $currentDay = getCurrentDay();
            $currentWeek = getCurrentWeek();
            $meetingsQuery->where('day', '=', $currentDay)->where('week', '=', $currentWeek)->where('status', '=', $status);
        }

        $pagination = getPagination($request);
        $meetings = $meetingsQuery->with(['user', 'participants'])->orderBy('day', 'asc')->paginate($pagination);
        return view('admin.meetings.index', ['meetings' => $meetings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = \App\Models\User::where('role_id', 1)->orderBy('id')->get();
        $students = \App\Models\User::where('role_id', 2)->orderBy('id')->get();
        $status = \App\Models\Meeting::getStatusOptions();

        return view('admin.meetings.create-edit', [
            'teachers' => $teachers,
            'students' => $students,
            'status' => $status,
            'type' => 'POST'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateMeeting($request);

        $meeting = Meeting::create([
            'day' => $request['day'],
            'time' => $request['time'],
            'week' => $request['week'],
            'status' => $request['status'],
            'user_id' => $request['teacher_id'],
        ]);
        $meeting->participants()->sync($request['participants']);

        try {
            // Guardar el nuevo usuario
            $meeting->save();
            return redirect()->route('admin.meetings.index')->with('success', 'La reunión del día <b>' . $meeting->day . '</b> ha sido creada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear la reunión.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        return view('admin.meetings.show', ['meeting' => $meeting]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        $meeting->load('participants');
        $teachers = \App\Models\User::where('role_id', 1)->orderBy('id')->get();
        $students = \App\Models\User::where('role_id', 2)->orderBy('id')->get();
        $status = \App\Models\Meeting::getStatusOptions();

        return view('admin.meetings.create-edit', [
            'meeting' => $meeting,
            'teachers' => $teachers,
            'students' => $students,
            'status' => $status,
            'type' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        // Validar los datos
        $this->validateMeeting($request);
        //dd($request);
        $meeting->day = $request->input('day');
        $meeting->time = $request->input('time');
        $meeting->week = $request->input('week');
        $meeting->status = $request->input('status');
        $meeting->user_id = $request->input('teacher_id');

        // Sincronizar los participantes
        if ($request->has('participants')) {
            $meeting->participants()->sync($request->input('participants'));
        }

        try {
            // Guardar los cambios
            $meeting->save();
            return redirect()->route('admin.meetings.index', $meeting)->with('success', 'La reunión del día <b>' . $meeting->day . '</b> ha sido actualizada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar la reunión.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('admin.meetings.index')->with('success', 'Reunión eliminada correctamente.');
    }

    /**
     * Validates module's data.
     */
    protected function validateMeeting(Request $request)
    {
        return $request->validate([
            'day' => 'required|numeric|min:1|max:5',
            'time' => 'required|numeric|min:1|max:6',
            'week' => 'required|numeric|min:1|max:39',
            'status' => 'required',
            'teacher_id' => 'required|exists:users,id',
        ], [
            'day.required' => 'El campo día es obligatorio.',
            'time.required' => 'El campo hora es obligatorio.',
            'week.required' => 'El campo semana es obligatorio.',
            'status.required' => 'El campo estado es obligatorio.',
            'teacher_id.required' => 'El campo profesor es obligatorio.',
        ]);
    }
}
