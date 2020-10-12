<?php

namespace App\Http\Livewire;

use App\Computer;
use App\Department;
use Livewire\Component;

class ComputerDetails extends Component
{


    public Computer $computer;
    public $newDepartment, $newDepartmentName, $existingDepartmentId;
    public $isEditable;

    protected $listeners = [
        'showComputerDetails' => 'showComputerDetails',
    ];

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

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
    }

    public function mount()
    {
        $this->computer = new Computer;
        $this->newDepartment = false;
        $this->isEditable = false;
    }

    public function showComputerDetails( $id ){
        $this->computer = Computer::find( $id );
        $this->existingDepartmentId = $this->computer->department_id; 
        // dd($this->computer);
    }

    public function toggleNewDepartment()
    {
        $this->newDepartment = !$this->newDepartment;
    }

    public function toggleEdit()
    {
        $this->computer = $this->computer->fresh();
        $this->existingDepartmentId = $this->computer->department_id;
        $this->newDepartment = false;
        $this->isEditable = !$this->isEditable;
    }

    public function save()
    {

        $this->computer->status = "Available";

        if ($this->newDepartment) {
            $dept = Department::firstOrNew(['department_name' => $this->newDepartmentName]);
            $dept->save();
            $this->computer->department_id = $dept->id;
        } else {
            $this->computer->department_id = $this->existingDepartmentId;
        }

        $this->computer->save();

        return redirect()->to('/computers');

    }

    public function destroy(){

        if( $this->computer->systemDetails != null ){
            $sys = $this->computer->systemDetails;
            $sys->clearPeripherals();
        }

        $this->computer->delete();
        return redirect()->to('/computers');
    }

    public function render()
    {
        return view('livewire.computer-details', [
            'types' => \App\ComputerType::all(),
            'departments' => \App\Department::all(),
        ]);
    }
}
