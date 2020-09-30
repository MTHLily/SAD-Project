<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Computer;
use App\Employee;
use App\Peripheral;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'assignments.index' )->with( [
            'assignments' => Assignment::all(),
            'computers' => Computer::all(),
            'employees' => Employee::all(),
            'peripherals' => Peripheral::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required',
            'computer_id' => 'required'
        ]);

        $assign = Assignment::create( $data );

        $assign->employee->status = "Assigned";
        $assign->employee->save();
        $assign->computer->status = "Assigned";
        $assign->computer->save();

        return redirect('/assignments');

    }

    /**
     * Return the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        return response()->json($assignment);
    }

    /**
     * Return the specified assignment's peripherals.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show_peripherals(Assignment $assignment)
    {
        return response()->json($assignment->peripherals);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        foreach( $assignment->peripherals as $peripheral ){
            $peripheral->assignment_id = null;
        }
        $assignment->delete();
        return redirect('/assignments');
    }
}
