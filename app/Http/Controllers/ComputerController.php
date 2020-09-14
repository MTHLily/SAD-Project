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

        //Create new instance of system details
        $systemDetail = new \App\SystemDetails;

        //Fill in data for the simple relationships
        $systemDetail->motherboard_id = $validatedData['motherboard_id'];
        $systemDetail->processor_id = $validatedData['processor_id'];
        $systemDetail->gpu_id = $validatedData['gpu_id'];
        $systemDetail->operating_system_id = $validatedData['operating_system_id'];
        $systemDetail->save();

        //Set the used components statuses to be In Use
        $motherboard = \App\Component::find($validatedData['motherboard_id']);
        $processor = \App\Component::find($validatedData['processor_id']);
        $gpu = \App\Component::find($validatedData['gpu_id']);

        $motherboard->status = "In Use";
        $processor->status = "In Use";
        $gpu->status = "In Use";

        $motherboard->save();
        $processor->save();
        $gpu->save();

        $computer->system_details_id = $systemDetail->id;
        $computer->save();

        //Create the complicated relationships
        $ram = new \App\Ram;
        $ram->component_id = $validatedData['ram_id'];
        $ram->system_id = $systemDetail->id;
        $ram->save();

        $ramComp = \App\Component::find( $validatedData['ram_id'] );
        $ramComp->status = 'In Use';
        $ramComp->save();

        $storage = new \App\Storage;
        $storage->component_id = $validatedData['storage_id'];
        $storage->system_id = $systemDetail->id;
        $storage->save();

        $storageComp = \App\Component::find( $validatedData['storage_id'] );
        $storageComp->status = 'In Use';
        $storageComp->save();

        $addRam = json_decode($validatedData['additionalRAM']);
        $addStorage = json_decode($validatedData['additionalStorage']);

        foreach( $addRam as $ram ){

            $ram = new \App\Ram;
            $ram->component_id = $validatedData['ram_id'];
            $ram->system_id = $systemDetail->id;
            $ram->save();

            $ramComp = \App\Component::find( $validatedData['ram_id'] );
            $ramComp->status = 'In Use';
            $ramComp->save();

        }

        foreach( $addStorage as $storage ){

            $storage = new \App\Storage;
            $storage->component_id = $validatedData['storage_id'];
            $storage->system_id = $systemDetail->id;
            $storage->save();

            $storageComp = \App\Component::find( $validatedData['storage_id'] );
            $storageComp->status = 'In Use';
            $storageComp->save();

        }

        return redirect( '/computers' );

    }

    public function showSystem( $id ){

        $motherboards = \App\Component::motherboards()->get();
        $cpus = \App\Component::cpus()->get();
        $gpus = \App\Component::gpus()->get();
        $rams = \App\Component::rams()->get();
        $storages = \App\Component::storages()->get();

        return view( 'computers.show_system', [
            'system' => \App\SystemDetails::find($id ),
            'motherboards' => $motherboards,
            'cpus' => $cpus,
            'gpus' => $gpus,
            'rams' => $rams,
            'storages' => $storages,
            'operatingSystems' => \App\OperatingSystem::all(),
        ]);
    }

    public function updateSystem( $id, Request $request ){

        //Get the system
        $system = \App\SystemDetails::find($id);

        $validatedData = $request->validate([
            "motherboard_id" => 'required',
            "processor_id" => 'required',
            "gpu_id" => 'required',
            "ram_id" => 'required',
            "storage_id" => 'required',
            "operating_system_id" => 'required',
            "rams" => '',
            "storages" => '',
        ]);

        //Free the old components
        $motherboard = \App\Component::find($system->motherboard_id);
        $processor = \App\Component::find($system->processor_id);
        $gpu = \App\Component::find($system->gpu_id);

        $motherboard->status = "Available";
        $processor->status = "Available";
        $gpu->status = "Available";

        $motherboard->save();
        $processor->save();
        $gpu->save();

        //Update the components
        $system->update([
            "motherboard_id" => $validatedData['motherboard_id'],
            "processor_id" => $validatedData['processor_id'],
            "storage_id" => $validatedData['storage_id'],
            "operating_system_id" => $validatedData['operating_system_id'],
        ]);

        //Set to In Use the new components
        $motherboard = \App\Component::find($validatedData['motherboard_id']);
        $processor = \App\Component::find($validatedData['processor_id']);
        $gpu = \App\Component::find($validatedData['gpu_id']);

        $motherboard->status = "In Use";
        $processor->status = "In Use";
        $gpu->status = "In Use";

        $motherboard->save();
        $processor->save();
        $gpu->save();

        //Save the old system
        $system->save();

        $ram_ids = json_decode( $validatedData['rams'] );
        $storage_ids = json_decode( $validatedData['storages'] );

        //Searches for existing RAM entries with the same ID
        foreach( $system->ram as $ram ){
            if( in_array($ram->component->id, $ram_ids) ){
                //If duplicate found, then remove the ID from the to be created list
                $index = array_search( $ram->component->id, $ram_ids );
                unset( $ram_ids[$index] );
            }
            else
                //If not, then existing storage component is made avaialable and model is deleted
                $ram->component->status = 'Available';
                $ram->delete();
        }

        //Searches for existing storage entries with the same ID
        foreach( $system->storage as $storage ){
            if( in_array($storage->component->id, $ram_ids) ){
                //If duplicate found, then remove the ID from the to be created list
                $index = array_search( $storage->component->id, $storage_ids );
                unset( $storage_ids[$index] );
            }
            else{
                //If not, then existing storage component is made avaialable and model is deleted
                $storage->component->status = 'Available';
                $storage->delete();
            }
        }

        foreach( $ram_ids as $ram_id ){

            $ram = new \App\Ram;
            $ram->component_id = ram_id;
            $ram->system_id = $system->id;
            $ram->save();

            $ramComp = \App\Component::find( ram_id );
            $ramComp->status = 'In Use';
            $ramComp->save();

        }

        foreach( $storage_ids as $storage_id){

            $storage = new \App\Storage;
            $storage->component_id = storage_id;
            $storage->system_id = $system->id;
            $storage->save();

            $storageComp = \App\Component::find( storage_id );
            $storageComp->status = 'In Use';
            $storageComp->save();

        }

        return redirect('/computers');

    }

}
