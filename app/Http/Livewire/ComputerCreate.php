<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Computer;
use App\Department;

class ComputerCreate extends Component
{

    public Computer $computer;
    public $newDepartment, $newDepartmentName, $existingDepartmentId;

    protected $rules = [
        'computer.asset_tag' => 'required',
        'computer.pc_name' => 'required',
        'computer.type' => 'required',
        'computer.department_id' => '',
        'computer.remarks' => '',
        'computer.issues' => '',
        'computer.status' => '',
        'newDepartmentName' => '',
    ];

    public function updated( $field ){
        $this->validateOnly( $field, $this->rules );
    }

    public function mount(){
        $this->computer = new Computer;
        $this->computer->type = 1;
        $this->newDepartment = false;
    }

    public function toggleNewDepartment(){
        $this->newDepartment = !$this->newDepartment;
    }

    public function save(){

        $this->computer->status = "Available";

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
