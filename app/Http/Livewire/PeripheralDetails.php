<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Peripheral;

class PeripheralDetails extends Component
{

    public Peripheral $peripheral;
    public $isEditable;

    protected $rules = [
        'peripheral.asset_tag' => 'required',
        'peripheral.peripheral_name' => 'required',
        'peripheral.peripheral_type' => 'required',
        'peripheral.status' => '',
        'peripheral.issues' => '',
        'peripheral.remarks' => '',
    ];

    protected $listeners = [
        'showPeripheralDetails' => 'showPeripheralDetails',
    ];

    public function showPeripheralDetails( $id ){
        $this->peripheral = Peripheral::find( $id );
        $this->isEditable = false;
    }

    public function toggleEdit(){
        $this->isEditable = !$this->isEditable;
        $this->peripheral = $this->peripheral->fresh();
    }

    public function mount(){
        $this->peripheral = new Peripheral;
    }

    public function save(){
        $this->validate();
        $this->peripheral->save();
        return redirect()->to('/peripherals');
    }

    public function destroy(){
        $this->peripheral->delete();
        return redirect()->to('/peripherals');
    }

    public function render()
    {
        return view('livewire.peripheral-details');
    }
}
