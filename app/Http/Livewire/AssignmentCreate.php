<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Assignment;
use App\Computer;
use App\Employee;

class AssignmentCreate extends Component
{

    public Assignment $assign;
    public  $computer;
    public  $employee;

    protected $rules = [
        'assign.computer_id' => '',
        'assign.employee_id' => '',
    ];

    // protected $listeners = [
    //     'showAssignmentCreate' => 'showAssignmentCreate',
    // ];

    // public function showAssignmentCreate(){}

    public function updated(){
        // dd($this->assign);
        $this->employee = $this->assign->employee;
        $this->computer = $this->assign->computer;
    }

    public function mount(){
        $this->assign = new Assignment;
        $this->computer = new Computer;
        $this->employee = new Employee;
    }

    public function getCanSaveProperty(){
        return $this->assign->computer_id != null && $this->assign->employee_id != null;
    }

    public function save(){
     
        $this->assign->save();
        $this->computer->status = "Assigned";
        $this->computer->save();
        $this->employee->status = "Assigned";
        $this->employee->save();

        return redirect()->to('/assignments');
    }

    public function render()
    {
        return view('livewire.assignment-create');
    }
}
