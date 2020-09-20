<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view ('employees.index', ['employee' =>Employee::all() ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        return view('employees.create');
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
                'department_id' =>'required',
                'status' =>'',
            ]
        );
        Employee::create($validatedData);
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
        return view('employees.edit',['employee' =>Employee::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){
        $employee = Employee::find( $id );
        $validatedData = $request->validate(
            [
                'last_name' =>'required',
                'first_name' =>'required',
                'middle_initial'=>'required',
                'department_id' =>'required',
                'status' => 'required',
                
            ]
        );
        $employee->last_name = $validatedData['last_name'];
        $employee->first_name = $validatedData['first_name'];
        $employee->middle_initial = $validatedData['middle_initial'];
        $employee->department_id =$validatedData['department_id'];

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
}
