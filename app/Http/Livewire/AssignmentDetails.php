<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Assignment;
use App\Computer;
use App\Employee;

class AssignmentDetails extends Component
{

    public Assignment $assign;
    public $computer;
    public $employee;
    public $isEditable;

    protected $rules = [
        'assign.computer_id' => '',
        'assign.employee_id' => '',
    ];

    protected $listeners = [
        'showAssignmentDetails' => 'showAssignmentDetails',
    ];

    public function toggleEdit(){

        $this->isEditable = !$this->isEditable;

    }

    public function showAssignmentDetails( $id ){
        $this->assign = Assignment::find($id);
        $this->employee = $this->assign->employee;
        $this->computer = $this->assign->computer;
    }

    public function hydrate()
    {
        $this->employee = $this->assign->employee;
        $this->computer = $this->assign->computer;
    }

    public function mount()
    {
        $this->assign = new Assignment;
        $this->computer = new Computer;
        $this->employee = new Employee;
    }

    public function getCanSaveProperty()
    {
        return $this->assign->computer_id != null && $this->assign->employee_id != null;
    }

    public function save()
    {
        $comp = $this->assign->computer;
        $comp->status = "Available";
        $comp->save();
        $emp = $this->assign->employee;
        $emp->status = "Available";
        $emp->save();

        $this->assign->save();

        $comp = $this->computer;
        $comp->status = "Assigned";
        $comp->save();
        $emp = $this->employee;
        $emp->status = "Assigned";
        $emp->save();

        return redirect()->to('/assignments');
    }

    public function destroyAssignment(){

        $this->computer->status = "Available";
        $this->computer->save();
        $this->employee->status = "Available";
        $this->employee->save();

        $this->assign->delete();
        return redirect()->to('/assignments');
    }

    public function render()
    {
        return view('livewire.assignment-details');
    }
}
