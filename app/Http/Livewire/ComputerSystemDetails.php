<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\SystemDetails;

class ComputerSystemDetails extends Component
{

    public SystemDetails $system;
    public $isEditable, $canAddRam, $canAddStorage;
    public $rams, $storages;
    public $ramCount, $storageCount;

    protected $rules = [
        'system.motherboard_id' => '',
        'system.processor_id' => '',
        'system.gpu_id' => '',
        'system.operating_system_id' => '',
    ];

    protected $listeners = [
        'showComputerSystemDetails' => 'showComputerSystemDetails',
        'refreshComponent' => '$refresh',
    ];

    public function resetValues(){
        $this->isEditable = false;
        $this->canAddRam = true;
        $this->canAddStorage = true;
    }

    public function mount(){
        $this->rams = [];
        $this->storages = [];
        $this->ramCount = 0;
        $this->storageCount = 0;
        $this->system = new SystemDetails;
        // $this->system->motherboard_id = 1;
        // $this->system->processor_id = 2;
        // $this->system->gpu_id = 3;
        // $this->system->operating_system_id = 1;
        $this->isEditable = false;
        $this->canAddRam = true;
        $this->canAddStorage = true;
    }

    public function showComputerSystemDetails( $id ){
        $comp = \App\Computer::find( $id );
        if( $comp->system_details_id == null ){
            $sys = new SystemDetails;
            $sys->save();
            
            $this->system = $sys;

            $comp->system_details_id = $sys->id;
            $comp->save();
        }
        else
            $this->system = $comp->systemDetails;

        $this->rams = $this->system->ram->map(function ($ram) {
            return $ram->component->id;
        })->toArray();

        $this->ramCount = count($this->rams);

        $this->storages = $this->system->storage->map(function ($storage) {
            return $storage->component->id;
        })->toArray();

        $this->storageCount = count($this->storages);

        $this->resetValues();

    }

    public function addRamCount(){
        array_push( $this->rams, 0 );
        $this->canAddRam = false;
        $this->ramCount++;
    }

    public function removeRam( $ind ){
        unset( $this->rams[$ind] );
        $this->rams = array_values($this->rams);
        $this->canAddRam = !(in_array(0, $this->rams));
        $this->ramCount--;
    }
    
    public function getAvailableRamProperty(){
        $system_ram = $this->system->ram->map( function ($ram) { return $ram->component; });
        $availableRam = \App\Component::rams()->where('status', 'Available')->get();
        return $availableRam->merge( $system_ram );
    }
    
    public function addStorageCount(){
        array_push( $this->storages, 0 );
        $this->canAddStorage = false;
        $this->storageCount++;
    }

    public function removeStorage( $ind ){
        unset( $this->storages[$ind] );
        $this->storages = array_values($this->storages);
        $this->canAddStorage = !(in_array(0, $this->storages));
        $this->storageCount--;
    }
    
    public function getAvailableStorageProperty(){
        $system_storage = $this->system->storage->map( function ($storage) { return $storage->component; });
        $availableStorage = \App\Component::storages()->where('status', 'Available')->get();
        return $availableStorage->merge( $system_storage );
    }
    
    public function toggleEdit(){
        $this->isEditable = !$this->isEditable;
    }

    public function updated(){
        $this->canAddRam = !(in_array(0, $this->rams));
        $this->canAddStorage = !(in_array(0, $this->storages));
    }
    public function getCanSaveProperty(){
        return $this->canAddRam && $this->canAddStorage;
    }

    public function save(){

        $motherboard = $this->system->motherboard;
        if($motherboard != null ){
            $motherboard->status = 'Available';
            $motherboard->save();
        }
    
        $cpu = $this->system->processor;
        if($cpu != null ){
            $cpu->status = 'Available';
            $cpu->save();
        }
    
        $gpu = $this->system->gpu;
        if( $gpu != null ){
            $gpu->status = 'Available';
            $gpu->save();
        }
    

        $this->system->save();

        $motherboard = \App\Component::find($this->system->motherboard_id);
        if($motherboard != null ){
            $motherboard->status = 'Assigned';
            $motherboard->save();
        }

        $cpu = \App\Component::find($this->system->processor_id);
        if($cpu != null ){
            $cpu->status = 'Assigned';
            $cpu->save();
        }

        $gpu = \App\Component::find($this->system->gpu_id);
        if( $gpu != null ){
            $gpu->status = 'Assigned';
            $gpu->save();
        }

        //Logic for the RAM
        $this->system->clearRam();
        foreach ($this->rams as $ram_id ) {
            $this->system->addRam( $ram_id );
        }

        $this->system->clearStorage();
        foreach ($this->storages as $storage_id ) {
            $this->system->addStorage( $storage_id );
        }

        return redirect()->to('/computers');

        $this->toggleEdit();
        $this->emitSelf('refreshComponent');

    }

    public function render()
    {
        return view('livewire.computer-system-details');
    }
}
