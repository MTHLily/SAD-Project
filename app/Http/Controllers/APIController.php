<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getAllComponents(){
        return response()->json( \App\Component::all() );
    }
    public function getComponent( $id ){
        return response()->json( \App\Component::find($id) );
    }


    public function getAllEmployees(){
        return response()->json(\App\Employee::all() );
    }
    public function getEmployee($id){
        return response()->json(\App\Employee::find($id) );
    }


    public function getAllComputers(){
        return response()->json(\App\Computer::all() );        
    }
    public function getComputer($id){
        return response()->json(\App\Computer::find($id));
    }


    public function getAllPeripherals(){
        return response()->json(\App\Peripheral::all());
    }
    public function getPeipheral($id){
        return response()->json(\App\Peripheral::find($id));
    }

    
    public function getAllAssignments(){
        return response()->json(\App\Assignment::all());
    }
    public function getAssignment($id){
        return response()->json(\App\Assignment::find($id));
    }

    public function getAllWarranties(){
        return response()->json(\App\Warranty::all());
    }
    public function getWarranty($id){
        return response()->json(\App\Warranty::find($id));
    }
    public function getWarrantyProducts($id){
        $war = \App\Warranty::find($id);
        return response()->json([
            'computer' => $war->computer,
            'peripheral' => $war->peripheral,
            'component' => $war->component,
        ]);
    }
}
