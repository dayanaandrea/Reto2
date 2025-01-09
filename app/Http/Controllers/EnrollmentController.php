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
        //where('role_id',2) is used to get only students
        $users = \App\Models\User::where('role_id',2)->orderBy('id')->get();
        $modules = \App\Models\Module::orderBy('id')->get();
        $cycles = \App\Models\Cycle::orderBy('id')->get();

        $enrollments = Enrollment::orderBy('id')->get();

        //dd('Llegó aquí');

        return view('admin.enrollment.create-edit', [
            'enrollments'=>$enrollments,
            'users' => $users,
            'modules' => $modules,
            'cycles' => $cycles,
            'type'=>'POST']);            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd('Antes de la validación');
        //dd($request->all());
        $validatedData = $request->validate([
            'student_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:modules,id',
            'cycle_id' => 'required|exists:cycles,id',
            'date' => 'required|date',
            'course' => 'required|integer|min:1|max:9',
        ]);
        //dd($validatedData);


        $enrollment = new Enrollment();
        $enrollment->student_id = $validatedData['student_id'];
        $enrollment->module_id = $validatedData['module_id'];
        $enrollment->cycle_id = $validatedData['cycle_id'];
        $enrollment->date = $validatedData['date'];
        $enrollment->course = $validatedData['course'];

        //dd($enrollment->student_id,$enrollment->module_id,$enrollment->cycle_id,$enrollment->date,$enrollment->course);  // Esto debería mostrarte el ID del usuario asignado

        // Guardar la nueva matrícula
        $enrollment->save();

        return redirect()->route('admin.enrollments.index')->with('success', 'Matricula  ' . $enrollment->id . ' creado correctamente.');
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
        //where('role_id',2) is used to get only students
        $users = \App\Models\User::where('role_id',2)->orderBy('id')->get();
        $modules = \App\Models\Module::orderBy('id')->get();
        $cycles = \App\Models\Cycle::orderBy('id')->get();

        return view('admin.enrollment.create-edit', [
            'enrollment'=>$enrollment,
            'users' => $users,
            'modules' => $modules,
            'cycles' => $cycles,
            //'date' => $date,
            //'course' => $course,
            'type'=>'PUT']);
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
