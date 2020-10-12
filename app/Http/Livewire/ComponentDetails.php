<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ComponentDetails extends Component
{

    public \App\Component $component;
    public $isEditable;

    protected $rules = [
        'component.asset_tag' => 'required',
        'component.component_name' => 'required',
        'component.component_type_id' => 'required',
        'component.status' => '',
        'component.issues' => '',
        'component.remarks' => '',
    ];

    protected $listeners = [
        'showComponentDetails' => 'showComponentDetails',
    ];

    public function showComponentDetails($id)
    {
        $this->component = \App\Component::find($id);
        $this->isEditable = false;
    }

    public function toggleEdit()
    {
        $this->isEditable = !$this->isEditable;
        $this->component = $this->component->fresh();
    }

    public function mount()
    {
        $this->component = new \App\Component;
    }

    public function save()
    {
        $this->validate();
        $this->component->save();
        return redirect()->to('/components');
    }

    public function destroy()
    {
        $this->component->delete();
        return redirect()->to('/components');
    }

    public function render()
    {
        return view('livewire.component-details');
    }
}
