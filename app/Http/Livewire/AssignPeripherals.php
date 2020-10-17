<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Assignment;
use App\Peripheral;

class AssignPeripherals extends Component
{

    public Assignment $assign;
    public $peripherals, $peripheralInd;
    public $isEditable;

    protected $listeners = [
        'showAssignPeripherals' => 'showAssignPeripherals',
        'refreshComponent' => '$refresh',
    ];
    
    public function toggleEdit(){
        $this->isEditable = !$this->isEditable;
        $this->peripheralInd = $this->assign->peripherals->map( function( $per ){ return $per->id; } )->toArray();
    }
    
    public function getAvailablePeripheralsProperty(){
        $system_peripherals = $this->assign->peripherals;
        return Peripheral::where('status', 'Available')->get()->merge( $system_peripherals )->sortBy('peripheral_type')->groupBy( 'peripheral_type' );
    }

    public function addPeripheral(){
        array_push( $this->peripheralInd, null );
    }

    public function removePeripheral( $ind ){
        unset( $this->peripheralInd[$ind] );
        $this->peripheralInd = array_values($this->peripheralInd);
        $this->emitSelf('refreshComponent');
    }


    public function showAssignPeripherals( $id ){
        $this->assign = Assignment::find( $id );
        $this->peripherals = $this->assign->peripherals->sortBy( 'peripheral_type' );
        
        $this->isEditable = false;
    }

    public function getCanAddProperty(){
        return !in_array( "", $this->peripheralInd );
    }

    public function getCanSaveProperty(){
        return $this->canAdd;
    }

    public function getSortedPeripheralsProperty(){
        return $this->assign->peripherals->sortBy('peripheral_type');
    }

    public function mount(){
        $this->assign = new Assignment;
        $this->peripherals = [];
    }

    public function save(){

        $this->assign->clearPeripherals();

        foreach ( $this->peripheralInd as $id ) {
            $per = Peripheral::find( $id );
            $per->assignment_id = $this->assign->id;
            $per->status = "Assigned";
            $per->save();
        }

        return redirect()->to('/assignments');

        $this->isEditable = false;
        $this->emitSelf('refreshComponent');

    }

    public function render()
    {
        return view('livewire.assign-peripherals');
    }
}
