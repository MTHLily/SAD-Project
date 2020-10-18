<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Peripheral;

class PeripheralDetails extends Component
{

    public Peripheral $peripheral;
    public $isEditable;
    public $asset_tag, $orig_tag;

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

    public function updated($field)
    {
        if ($field == 'asset_tag' && $this->asset_tag != $this->orig_tag )
            $this->validate(['asset_tag' => 'unique:peripherals|required',]);
        else
            $this->validateOnly($field, $this->rules);
    }

    public function showPeripheralDetails( $id ){
        $this->peripheral = Peripheral::find( $id );
        $this->asset_tag = $this->peripheral->asset_tag;
        $this->orig_tag = $this->asset_tag;
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

        if ($this->asset_tag != $this->orig_tag)
            $this->validate(['asset_tag' => 'unique:peripherals|required',]);
        $this->peripheral->asset_tag = $this->asset_tag;

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
