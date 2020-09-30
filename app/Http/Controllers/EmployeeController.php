<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view ('employees.index', ['employees' =>Employee::all() ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        return view('employees.create',['departments'=>Department::all()]);
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request){
        $validatedData = $request->validate(
            [
                'last_name' =>'required',
                'first_name' =>'required',
                'middle_initial'=>'required',
                'email_address' =>'required',
                'department_id' =>' ',
                'new_department'=>'max:255',
                
            ]
        );
        $employee = new Employee;
        $employee->last_name = $validatedData['last_name'];
        $employee->first_name = $validatedData['first_name'];
        $employee->middle_initial = $validatedData['middle_initial'];
        $employee->email_address = $validatedData['email_address'];
        $employee->department_id =$validatedData['department_id'];
        
        if( $validatedData['department_id'] != 'new_department' )
            $employee->department_id = $validatedData['department_id'];
        else{
            $department = Department::firstOrNew( [ 'department_name' => $validatedData['new_department'] ]);
            $department->save();
            $employee->department_id = $department->id;
        }
        $employee->save();
        
        return redirect('/employees');
     }
      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        return view('employees.edit',['employee' =>Employee::find($id),'departments'=>Department::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){
        $validatedData = $request->validate(
            [
                'last_name' =>'required',
                'first_name' =>'required',
                'middle_initial'=>'required',
                'department_id' =>'',
                'email_address' =>'required',
                'new_department'=>'max:255',
            ]
        );
        $employee = Employee::find( $id );
        $employee->last_name = $validatedData['last_name'];
        $employee->first_name = $validatedData['first_name'];
        $employee->middle_initial = $validatedData['middle_initial'];
        $employee->email_address = $validatedData['email_address'];
       

        if( $validatedData['department_id'] != 'new_department' )
            $employee->department_id = $validatedData['department_id'];
        else{
            $department = Department::firstOrNew( [ 'department_name' => $validatedData['new_department'] ]);
            $department->save();
            $employee->department_id = $department->id;
        }
        $employee->save();
        return redirect( '/employees' );

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Employee::destroy($id);
        return redirect( '/employees');
    }

    /**
     *  Fetch all employees and send as JSON
     *
     * @return \Illuminate\Http\Response
     */

    public function apiAll(){
        return response()->json( Employee::all() );
    }

}
