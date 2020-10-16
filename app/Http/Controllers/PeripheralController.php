<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peripheral;

class PeripheralController extends Controller
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
        return view( 'peripherals.index', [ 'peripherals' => Peripheral::all(), ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peripherals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'asset_tag' => 'required|max:255|unique:peripherals',
                'peripheral_name' => 'required|max:255',
                'peripheral_type' => 'required',
                'issues' => '',
                'remarks' => '',
            ]
        );

        Peripheral::create( $validatedData );

        return redirect( '/peripherals' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view( 'peripherals.edit', ['peripheral' => Peripheral::find($id)] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'asset_tag' => 'required|max:255',
                'peripheral_name' => 'required|max:255',
                'peripheral_type' => 'required',
                'issues' => '',
                'remarks' => '',
            ]
        );

        $peripheral = Peripheral::find( $id );
        $peripheral->update( $validatedData );

        return redirect('/peripherals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Peripheral::destroy($id);
        return redirect( '/peripherals' );
    }

    /**
     *  Fetch all available peripherals and send as JSON
     *
     * @return \Illuminate\Http\Response
     */

    public function apiAvailable()
    {
        return response()->json(Peripheral::where('status', 'Available')->get());
    }

}
