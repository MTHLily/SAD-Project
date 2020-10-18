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
    public $filterEmployee, $filterComputer;
    public $computer_id, $employee_id;

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
        $this->employee_id = $this->assign->employee_id;
        $this->computer_id = $this->assign->computer_id;
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


    public function getFilteredEmployeesProperty()
    {
        return Employee::where('last_name', 'like', $this->filterEmployee . '%')->orWhere('first_name', 'like', $this->filterEmployee . '%');
    }

    public function getFilteredComputersProperty()
    {
        $filtered = Computer::where('pc_name', 'like', $this->filterComputer . '%')->orWhere('asset_tag', 'like', $this->filterComputer . '%')->get();
        return $filtered->where('status', 'Available');
    }

    public function save()
    {
        $comp = Computer::find($this->assign->computer_id);
        $comp->status = "Available";
        $comp->save();
        $emp = Employee::find($this->assign->employee_id );
        $emp->status = "Available";
        $emp->save();

        $this->assign->computer_id = $this->computer_id;
        $this->assign->employee_id = $this->employee_id;

        $this->assign->save();

        $comp = Computer::find($this->computer_id);
        $comp->status = "Assigned";
        $comp->save();
        $emp = Employee::find( $this->employee_id );
        $emp->status = "Assigned";
        $emp->save();

        return redirect()->to('/assignments');
    }

    public function destroyAssignment(){

        $this->computer->status = "Available";
        $this->computer->save();
        $this->employee->status = "Available";
        $this->employee->save();

        $assignment = $this->assign;
        $assignment->clearPeripherals();

        $this->assign->delete();
        return redirect()->to('/assignments');
    }

    public function render()
    {
        return view('livewire.assignment-details');
    }
}
