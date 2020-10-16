<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Component;

class ComponentController extends Controller
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

        return view( 'components.index', [ 'components' => Component::all() ] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view( 'components.create' );

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
                'asset_tag' => 'required|max:255|unique:components',
                'component_name' => 'required|max:255',
                'component_type_id' => 'required',
                'issues' => '',
                'remarks' => '',
            ]
        );

        Component::create( $validatedData );

        return redirect( '/components' );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {

        return view( 'components.edit', [ 'component' => Component::find( $id ) ] );

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

        $component = Component::find( $id );

        $validatedData = $request->validate(
            [
                'asset_tag' => 'required|max:255',
                'component_name' => 'required|max:255',
                'component_type_id' => 'required',
            ]
        );

        $component->asset_tag = $validatedData['asset_tag'];
        $component->component_name = $validatedData['component_name'];
        $component->component_type_id = $validatedData['component_type_id'];

        $component->save();

        return redirect( '/components' );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Component::destroy($id);
        return redirect( '/components' );

    }
}
