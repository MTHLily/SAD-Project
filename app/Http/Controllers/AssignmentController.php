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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
    public function showPeripherals(Assignment $assignment)
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
     * Assign peripherals to an assignment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */

     public function editPeripherals(Request $request, Assignment $assignment ){

        $data = $request->validate([
            'peripheral_id' => '',
            'peripheral_ids' => 'JSON',
        ]);

        $assignment->clearPeripherals();
        $ids = json_decode( $data['peripheral_ids'] );

        foreach( $ids as $id ){
            \App\Peripheral::find( $id )->update([
                'assignment_id' => $assignment->id,
                'status' => 'Assigned',
            ]);
        }

        return redirect('/assignments');

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
        //Validate data
        $data = $request->validate([
                'employee_id' => 'required',
                'computer_id' => 'required',
            ]
        );

        //Unassign
        $emp = $assignment->employee;
        $emp->update(['status' => "Available"]);
        $com = $assignment->computer;
        $com->update(['status' => "Available"]);
        
        $assignment->update( $data );

        //Assign
        $emp = $assignment->employee;
        $emp->update(['status' => "Assigned"]);
        $com = $assignment->computer;
        $com->update(['status' => "Assigned"]);
        
        return redirect('/assignments');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        
        $assignment->clearPeripherals();

        $emp = $assignment->employee;
        $emp->update( ['status' => "Available"] );
        $com = $assignment->computer;
        $com->update( ['status' => "Available"] );

        $assignment->delete();
        return redirect('/assignments');
    }
}
