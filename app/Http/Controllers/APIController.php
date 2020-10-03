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
}
