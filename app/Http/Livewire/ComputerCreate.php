<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Computer;
use App\Department;

class ComputerCreate extends Component
{

    public Computer $computer;
    public $newDepartment, $newDepartmentName, $existingDepartmentId;
    public $asset_tag;

    protected $rules = [
        'computer.pc_name' => 'required',
        'computer.type' => 'required',
        'computer.department_id' => '',
        'computer.remarks' => '',
        'computer.issues' => '',
        'computer.status' => '',
        'newDepartmentName' => '',
        'asset_tag' => ['required', 'unique:computers'],
    ];

    public function updated( $field ){
        
        $this->validateOnly( $field, $this->rules );

    }

    public function mount(){
        $this->computer = new Computer;
        $this->computer->type = 1;
        $this->newDepartment = false;
        $this->asset_tag = "";
    }

    public function toggleNewDepartment(){
        $this->newDepartment = !$this->newDepartment;
    }

    public function save(){

        $this->validate();

        $this->computer->status = "Available";
        $this->computer->asset_tag = $this->asset_tag;

        if( $this->newDepartment ){
            $dept = Department::firstOrNew(['department_name' => $this->newDepartmentName ]);
            $dept->save();
            $this->computer->department_id = $dept->id;
        }
        else{
            $this->computer->department_id = $this->existingDepartmentId;
        }

        $this->computer->save();

        return redirect()->to('/computers');

        dd( $this->computer );
    }

    public function render()
    {
        return view('livewire.computer-create', [
            'types' => \App\ComputerType::all(),
            'departments' => \App\Department::all(),
        ]);
    }
}
