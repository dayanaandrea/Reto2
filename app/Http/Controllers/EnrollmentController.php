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
        $enrollments = Enrollment::orderBy('id', 'desc')->paginate(10);
        return view('admin.enrollments.index',['enrollments' => $enrollments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //where('role_id',2) is used to get only students
        $users = \App\Models\User::where('role_id',2)->orderBy('id')->get();
        $modules = \App\Models\Module::orderBy('id')->get();

        //$modules = \App\Models\Module::orderBy('id')->where('')->get();

        $enrollments = Enrollment::orderBy('id')->get();

        //dd('Llegó aquí');

        return view('admin.enrollments.create-edit', [
            'enrollments'=>$enrollments,
            'users' => $users,
            'modules' => $modules,
            'type'=>'POST']);            
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       /* //dd('Antes de la validación');
        //dd($request->all());*/
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:modules,id',
            'date' => 'required|date',
        ]);
        //dd($validatedData);


        $enrollment = new Enrollment();
        $enrollment->user_id = $validatedData['user_id'];
        $enrollment->module_id = $validatedData['module_id'];
        $enrollment->date = $validatedData['date'];
        
        //dd($enrollment->user_id,$enrollment->module_id,$enrollment->cycle_id,$enrollment->date,$enrollment->course);  // Esto debería mostrarte el ID del usuario asignado

        //dd para comprobar la multiple selección de módulos
        dd($enrollment->module_id,$enrollment->user_id,$enrollment->date);


        //foreach($validatedData[$module_id] as )

        // Guardar la nueva matrícula
        $enrollment->save();
        return redirect()->route('admin.enrollments.show')->with('success', 'Matricula  <b>' . $enrollment->enrollment . '</b> creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        return view('admin.enrollments.show',['enrollment'=>$enrollment]);
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

        return view('admin.enrollments.create-edit', [
            'enrollment'=>$enrollment,
            'users' => $users,
            'modules' => $modules,
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
            'user_id' => 'required|integer',
            'module_id' => 'required|integer',
            'date' => 'required|date',
        ]);
    
        $enrollment->update($validatedData);
    
        return redirect()->route('admin.enrollments.show',$enrollment)->with('success', 'Matricula  <b>' . $enrollment->enrollment . '</b> creado correctamente.');   
         
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
        return view('admin.enrollments.success', ['id'=>$id]); 
        */
    }
}
