<?php

namespace App\Http\Controllers;

use App\PeripheralSetup;
use Illuminate\Http\Request;

class PeripheralSetupController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'assignments.peripheral_setup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PeripheralSetup  $peripheralSetup
     * @return \Illuminate\Http\Response
     */
    public function show(PeripheralSetup $peripheralSetup)
    {
        return view('assignments.peripheral_setup.edit')->with( $peripheralSetup );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeripheralSetup  $peripheralSetup
     * @return \Illuminate\Http\Response
     */
    public function edit(PeripheralSetup $peripheralSetup)
    {
        return view('assignments.peripheral_setup.edit')->with( ['setup' => $peripheralSetup] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeripheralSetup  $peripheralSetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeripheralSetup $peripheralSetup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeripheralSetup  $peripheralSetup
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeripheralSetup $peripheralSetup)
    {
        //
    }

}
