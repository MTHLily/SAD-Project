<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ComponentDetails extends Component
{

    public \App\Component $component;
    public $isEditable;
    public $asset_tag, $orig_tag;

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

    public function updated($field)
    {
        if ($field == 'asset_tag' && $this->asset_tag != $this->orig_tag)
            $this->validate(['asset_tag' => 'unique:components|required',]);
        else
            $this->validateOnly($field, $this->rules);
    }
    public function showComponentDetails($id)
    {
        $this->component = \App\Component::find($id);
        $this->asset_tag = $this->component->asset_tag;
        $this->orig_tag = $this->asset_tag;
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
        if($this->asset_tag != $this->orig_tag )
            $this->validate(['asset_tag' => 'unique:components|required',]);
        $this->component->asset_tag = $this->asset_tag;
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
