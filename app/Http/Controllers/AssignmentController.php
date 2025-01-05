<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
=======
use App\Models\Schedule;
use Illuminate\Http\Request;

<<<<<<<< HEAD:app/Http/Controllers/ScheduleController.php
class ScheduleController extends Controller
========
class AssignmentController extends Controller
>>>>>>>> main:app/Http/Controllers/AssignmentController.php
>>>>>>> main
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< HEAD
        $assignments = Assignment::orderBy('created_at')->get();
        return view('assignments.index', ['assignments'=> $assignments]);
=======
        //
>>>>>>> main
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
<<<<<<< HEAD
    public function show(Assignment $assignment)
    {
        return view('assignments.show',['assignment'=>$assignment]);
=======
    public function show(Schedule $schedule)
    {
        //
>>>>>>> main
    }

    /**
     * Show the form for editing the specified resource.
     */
<<<<<<< HEAD
    public function edit(assignment $assignment)
=======
    public function edit(Schedule $schedule)
>>>>>>> main
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    public function update(Request $request, assignment $assignment)
=======
    public function update(Request $request, Schedule $schedule)
>>>>>>> main
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
<<<<<<< HEAD
    public function destroy(assignment $assignment)
=======
    public function destroy(Schedule $schedule)
>>>>>>> main
    {
        //
    }
}
