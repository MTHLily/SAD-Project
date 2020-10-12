<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Employee;

class EmployeeDetails extends Component
{

    public Employee $emp;
    public $isEditable, $newDepartment;
    public $newDepartmentName, $departmentId;

    public $rules = [
        'emp.first_name' => 'required',
        'emp.last_name' => 'required',
        'emp.middle_initial' => '',
        'emp.email_address' => '',
        'emp.status' => '',
    ];

    public $listeners = [
        'showEmployeeDetails' => 'showEmployeeDetails',
    ];

    public function showEmployeeDetails($id){
        $this->emp = Employee::find($id);
        $this->departmentId = $this->emp->department_id;
        $this->isEditable = false;
    }

    public function toggleEdit(){
        $this->isEditable = !$this->isEditable;
        $this->newDepartment = false;
        $this->emp = $this->emp->fresh();
    }

    public function toggleNewDepartment(){
        $this->newDepartment = !$this->newDepartment;
    }

    public function mount(){
        $this->emp = new Employee;
    }

    public function save(){
        
        if( $this->newDepartment ){
            $dept = \App\Department::firstOrNew( ['department_name' => $this->newDepartmentName] );
            $dept->save();
            $this->emp->department_id = $dept->id; 
        }
        else{
            $this->emp->department_id = $this->departmentId;
        }

        $this->emp->save();

        return redirect()->to('employees');
    }

    public function destroy(){
        $this->emp->delete();
        return redirect()->to('employees');
    }

    public function render()
    {
        return view('livewire.employee-details');
    }
}
