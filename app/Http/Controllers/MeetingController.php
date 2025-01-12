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
        $meetings = Meeting::orderBy('date', 'asc')->paginate(10);
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

        $meetings = Meeting::orderBy('date')->get();

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
          $meeting->date = $request->date;
          $meeting->time = $request->time;
          $meeting->status = $request->status;
          $meeting->teacher_id = $request->teacher_id;
          $meeting->student_id = $request->student_id;
  
          // Guardar el nuevo usuario
          $meeting->save();
          return redirect()->route('admin.meetings.index')->with('success', 'Reunión  ' . $meeting->name . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        return view('admin.meetings.show',['meetings'=>$meeting]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        $teachers = \App\Models\User::where('role_id',1)->orderBy('id')->get();
        $students = \App\Models\User::where('role_id',2)->orderBy('id')->get();
        $status = \App\Models\Meeting::getStatusOptions();

        $meetings = Meeting::orderBy('date')->get();

        return view('admin.meetings.create-edit', [
           'meetings' => $meetings,
           'teachers' => $teachers,
           'students' => $students,
           'status' => $status,
           'type'=>'POST']); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('admin.meetings.index')->with('success', 'Reunión eliminada correctamente.');
       
    }
}
