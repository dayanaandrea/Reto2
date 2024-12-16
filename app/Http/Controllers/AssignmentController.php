<?php

namespace App\Http\Controllers;

use App\Models\assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::orderBy('created_at')->get();
        return view('assignments.index', ['assignments'=> $assignments]);
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
    public function show(Assignment $assignment)
    {
        return view('assignments.show',['assignment'=>$assignment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(assignment $assignment)
    {
        //
    }
}
