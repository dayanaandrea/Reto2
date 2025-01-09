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
        $meetings = Meeting::orderBy('date')->get();
        return view('admin.meetings.create-edit', ['meetings'=>$meetings]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // Crear la reunión
          $meetings = new Meeting();
          $meetings->date = $request->date;
          $meetings->time = $request->time;
          $meetings->status = $request->status;
          $meetings->teacher->name = $request->name;
          $meetings->student->name = $request->name;
  
          // Guardar el nuevo usuario
          $meetings->save();
          return redirect()->route('admin.meetings.index')->with('success', 'Reunión  ' . $meetings->name . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meetings $meetings)
    {
        return view('admin.meetings.show',['meetings'=>$meetings]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        return view('admin.meetings.create-edit', ['meetings'=>$meetings]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
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
