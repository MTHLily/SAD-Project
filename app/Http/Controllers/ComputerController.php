<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Computer;
use App\Department;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'computers.index', [ 'computers' => Computer::all() ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'computers.create', [ 'departments' => Department::all() ] );
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
                'asset_tag' => 'required|max:255',
                'pc_name' => 'required|max:255',
                'computer_type' => 'required',
                'department_id' => '',
                'new_department' => 'max:255'
            ]
        );

        $computer = new Computer;
        $computer->asset_tag = $validatedData['asset_tag'];
        $computer->pc_name = $validatedData['pc_name'];
        $computer->type = $validatedData['computer_type'];

        if( $validatedData['department_id'] != 'new_department' )
            $computer->department_id = $validatedData['department_id'];
        else{
            $department = Department::firstOrNew( [ 'department_name' => $validatedData['new_department'] ]);
            $department->save();
            $computer->department_id = $department->id;
        }

        $computer->save();
        return redirect( '/computers' );

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
        return view( 'computers.edit', [ 'computer' => Computer::find( $id ), 'departments'=>Department::all() ] );
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
                'pc_name' => 'required|max:255',
                'computer_type' => 'required',
                'department_id' => '',
                'new_department' => 'max:255',
                'remarks' => 'max:255',
                'issues' => 'max:255',
            ]
        );

        $computer = Computer::find($id);
        $computer->asset_tag = $validatedData['asset_tag'];
        $computer->pc_name = $validatedData['pc_name'];
        $computer->type = $validatedData['computer_type'];
        $computer->remarks = $validatedData['remarks'];
        $computer->issues = $validatedData['issues'];

        if( $validatedData['department_id'] != 'new_department' )
            $computer->department_id = $validatedData['department_id'];
        else{
            $department = Department::firstOrNew( [ 'department_name' => $validatedData['new_department'] ]);
            $department->save();
            $computer->department_id = $department->id;
        }

        $computer->save();

        return redirect( '/computers' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Computer::destroy($id);
        return redirect( '/computers' );
    }

    /**
    * Assign Network Details to the resource
    *
    * @param int $id
    * @return \Illuminate\Http\Response
    */
    public function assignNetworkDetails( $id, Request $request ){

        $validatedData = $request->validate([
            'mac_address' => 'required|max:255',
            'wifi_address' => 'required|max:255',
        ]);

        $networkDetails = new \App\NetworkDetails;
        $networkDetails->mac_address = $validatedData['mac_address'];
        $networkDetails->wifi_address = $validatedData['wifi_address'];
        $networkDetails->save();

        $computer = Computer::find( $id );

        $computer->network_details_id = $networkDetails->id;
        $computer->save();

        return redirect( '/computers' );

    }

     public function editNetworkDetails( $id, Request $request ){

        $validatedData = $request->validate([
            'mac_address' => 'required|max:255',
            'wifi_address' => 'required|max:255',
        ]);

        $networkDetails = \App\NetworkDetails::find( $id );
        $networkDetails->mac_address = $validatedData['mac_address'];
        $networkDetails->wifi_address = $validatedData['wifi_address'];
        $networkDetails->save();

        return redirect( '/computers' );

    }

    public function createSystemDetails( $id ){

        $motherboards = \App\Component::motherboards()->get();
        $cpus = \App\Component::cpus()->get();
        $gpus = \App\Component::gpus()->get();
        $rams = \App\Component::rams()->get();
        $storages = \App\Component::storages()->get();

        return view( 'computers.create_system', [ 
            'computer' => Computer::find($id),
            'motherboards' => $motherboards,
            'cpus' => $cpus,
            'gpus' => $gpus,
            'rams' => $rams,
            'storages' => $storages,
            'operatingSystems' => \App\OperatingSystem::all(),
        ]);

    }

    public function assignSystem( $id, Request $request ){

        $computer = Computer::find( $id );

        $validatedData = $request->validate([
            "motherboard_id" => 'required',
            "processor_id" => 'required',
            "gpu_id" => 'required',
            "ram_id" => 'required',
            "storage_id" => 'required',
            "operating_system_id" => 'required',
            "additionalRAM" => '',
            "additionalStorage" => '',
        ]);

        $systemDetail = new \App\SystemDetails;

        $systemDetail->motherboard_id = $validatedData['motherboard_id'];
        $systemDetail->processor_id = $validatedData['processor_id'];
        $systemDetail->gpu_id = $validatedData['gpu_id'];
        $systemDetail->operating_system_id = $validatedData['operating_system_id'];
        $systemDetail->save();

        $computer->system_details_id = $systemDetail->id;
        $computer->save();


        $ram = new \App\Ram;
        $ram->component_id = $validatedData['ram_id'];
        $ram->system_id = $systemDetail->id;
        $ram->save();

        $storage = new \App\Storage;
        $storage->component_id = $validatedData['storage_id'];
        $storage->system_id = $systemDetail->id;
        $storage->save();

        $addRam = json_decode($validatedData['additionalRAM']);
        $addStorage = json_decode($validatedData['additionalStorage']);

        foreach( $addRam as $ram ){

            $ram = new \App\Ram;
            $ram->component_id = $validatedData['ram_id'];
            $ram->system_id = $systemDetail->id;
            $ram->save();

        }

        foreach( $addStorage as $storage ){

            $storage = new \App\Storage;
            $storage->component_id = $validatedData['storage_id'];
            $storage->system_id = $systemDetail->id;
            $storage->save();

        }

        return redirect( '/computers' );

    }

    public function showSystem( $id ){
        return view( 'computers.show_system', \App\SystemDetails::find($id ) );
    }

}
