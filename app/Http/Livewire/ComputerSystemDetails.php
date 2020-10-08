<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\SystemDetails;
use App\Computer;

class ComputerSystemDetails extends Component
{

    public SystemDetails $system;
    public $isEditable;

    public function mount(){
        $this->system = new SystemDetails;
        $this->system->motherboard_id = 1;
        $this->system->processor_id = 2;
        $this->system->gpu_id = 3;
        $this->system->operating_system_id = 1;
        $this->isEditable = false;
    }

    public function toggleEdit(){
        $this->isEditable = !$this->isEditable;
    }

    public function render()
    {
        return view('livewire.computer-system-details');
    }
}
