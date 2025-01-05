<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Schedule;
use Illuminate\Http\Request;

<<<<<<<< HEAD:app/Http/Controllers/ScheduleController.php
class ScheduleController extends Controller
========
class AssignmentController extends Controller
>>>>>>>> main:app/Http/Controllers/AssignmentController.php
=======
use App\Models\schedules;
use Illuminate\Http\Request;

class ScheduleController extends Controller
>>>>>>> main
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Schedule $schedule)
=======
    public function show(schedules $schedules)
>>>>>>> main
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
<<<<<<< HEAD
    public function edit(Schedule $schedule)
=======
    public function edit(schedules $schedules)
>>>>>>> main
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    public function update(Request $request, Schedule $schedule)
=======
    public function update(Request $request, schedules $schedules)
>>>>>>> main
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
<<<<<<< HEAD
    public function destroy(Schedule $schedule)
=======
    public function destroy(schedules $schedules)
>>>>>>> main
    {
        //
    }
}
