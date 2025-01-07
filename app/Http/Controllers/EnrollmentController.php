<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::orderBy('id', 'asc')->paginate(10);
        return view('admin.enrollment.index',['enrollments' => $enrollments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enrollments = Enrollment::orderBy('id')->get();
        return view('admin.module.create', ['enrollments'=>$enrollments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crear la matricula
        $enrollments = new Enrollment();
        $enrollments->student_id = $request->student_id;
        $enrollments->module_id = $request->module_id;
        $enrollments->cycle_id = $request->cycle_id;
        $enrollments->date = $request->date;
        $enrollments->course = $request->course;

        // Validar datos
        $validatedData = $request->validate([
            'student_id' => 'required|unsignedBigInteger|min:1',
            'module_id' => 'required|unsignedBigInteger|min:1',
            'cycle_id' => 'required|unsignedBigInteger|min:1',
            'date' => 'required|date',
            'course' => 'required|integer|min:1|max:9',
        ]);

        // Guardar la nueva matricula
        $enrollments->save();

        return redirect()->route('admin.enrollments.index')->with('success', 'Matricula  ' . $enrollments->id . ' creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        return view('admin.enrollment.show',['enrollment'=>$enrollment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        return view('admin.enrollment.edit', ['enrollment' => $enrollment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'module_id' => 'required|integer',
            'cycle_id' => 'required|integer',
            'date' => 'required|date',
            'course' => 'required|string|max:255',
        ]);
    
        $enrollment->update($validatedData);
    
        return redirect()->route('admin.enrollments.index')->with('success', 'Matricula actualizada correctamente.');   
         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Matricula eliminada correctamente.');
        /*
        $id = $enrollment->id; 
        $enrollment->delete(); 
        return view('admin.enrollment.success', ['id'=>$id]); 
        */
    }
}
