<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\User; 
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings = Meeting::orderBy('day', 'asc')->paginate(10);
        return view('admin.meetings.index',['meetings' => $meetings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = \App\Models\User::where('role_id',1)->orderBy('id')->get();
        $students = \App\Models\User::where('role_id',2)->orderBy('id')->get();
        $status = \App\Models\Meeting::getStatusOptions();

        $meetings = Meeting::orderBy('day')->get();

        return view('admin.meetings.create-edit', [
           'meetings' => $meetings,
           'teachers' => $teachers,
           'students' => $students,
           'status' => $status,
           'type'=>'POST']);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // Crear la reunión
          $meeting = new Meeting();
          $meeting->day = $request->day;
          $meeting->time = $request->time;
          $meeting->week = $request->week;
          $meeting->status = $request->status;
          $meeting->teacher_id = $request->teacher_id;
          $meeting->student_id = $request->student_id;
  
          // Guardar el nuevo usuario
          $meeting->save();
          return redirect()->route('admin.meetings.index')->with('success', 'La reunión con la fecha <b>' . $meeting->day . '</b> ha sido creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        return view('admin.meetings.show',['meeting'=>$meeting]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        $teachers = \App\Models\User::where('role_id',1)->orderBy('id')->get();
        $students = \App\Models\User::where('role_id',2)->orderBy('id')->get();
        $status = \App\Models\Meeting::getStatusOptions();

        return view('admin.meetings.create-edit', [
           'meeting' => $meeting,
           'teachers' => $teachers,
           'students' => $students,
           'status' => $status,
           'type'=>'PUT']); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        // Validar los datos
        $this->validateMeeting($request);

        //$schedule->schedule = strtolower($request->schedule);
        //dd($request);
        $meeting->date = $request->date;
        $meeting->time = $request->time;
        $meeting->week = $request->week;
        $meeting->status = $request->status;
        $meeting->teacher_id = $request->teacher_id;
        $meeting->student_id = $request->student_id;
        // Guardar el nuevo horario
        $meeting->save();

        return redirect()->route('admin.meetings.index', $meeting)->with('success', 'La reunión con la fecha <b>' . $meeting->day . '</b> ha sido actualizada correctamente.');
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
    private function validateMeeting(Request $request)
    {
        $request->validate([
           
            'day' => 'required',
            'time' => 'required',
            'week' => 'required',
            'status' => 'required',
            'teacher_id' => 'required',
            'student_id' => 'required',
        ], [
            'date.required' => 'La fecha es obligatoria.',
            'time.required' => 'El campo hora es obligatorio.',
            'week.required' => 'El campo semana es obligatorio.',
            'status.required' => 'El campo del estado de la reunión es obligatorio.',
            'teacher_id.required' => 'El campo del profesor es obligatorio.',
            'student_id.required' => 'El campo del estudiante es obligatorio.',
        ]);
    }
}
