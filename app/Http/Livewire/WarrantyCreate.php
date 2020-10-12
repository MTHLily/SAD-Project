<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Warranty;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class WarrantyCreate extends Component
{

    use WithFileUploads;

    public Warranty $warranty;
    public $model_category, $model_id;
    public $newBrand = false;
    public $purchase, $life, $warrantyImage, $newBrandName, $brandId, $assignWarrantyID, $selectedWarranty;

    protected $listeners = [
        'showWarrantyCreate' => 'showWarrantyCreate',
        'assignWarranty' => 'assignWarranty',
        'createWarranty' => 'createWarranty',
    ];

    protected $rules = [
        'warranty.purchase_date' => '',
        'warranty.purchase_location' => 'required',
        'warranty.receipt_url' => '',
        'warranty.serial_no' => '',
        'warranty.warranty_life' => '',
        'warranty.notes' => '',
        'warranty.status' => '',
    ];

    public function mount()
    {
        $this->warranty = new Warranty;
        $this->purchase = Carbon::now()->format('Y-m-d');
        $this->life = Carbon::now()->format('Y-m-d');
    }

    public function hydrate(){
        $this->warranty->purchase_date = Carbon::createFromFormat('Y-m-d', $this->purchase);
        $this->warranty->warranty_life = Carbon::createFromFormat('Y-m-d', $this->life);
    }

    public function updatedWarrantyImage()
    {
        $this->validate([
            'warrantyImage' => 'image',
        ]);
    }

    public function showWarrantyCreate( $category, $id ){
        $this->model_category = $category;
        $this->model_id = $id;
    }

    public function toggleNewBrand()
    {
        $this->newBrand = !$this->newBrand;
    }


    public function assignWarranty( $id )
    {
        $this->model->warranty_id = $id;
        $this->model->save();

        return $this->redirect;
    }
    
    public function createWarranty(){

        // dd( $this->warranty );
        // return;

        $data = $this->validate([
            'warrantyImage' => '',
            'warranty.purchase_location' => 'required',
            'brandId' => ($this->newBrandName) ? '' : 'required',
        ]);
            
        if ($this->newBrand) {
            $brand = \App\Brand::firstOrNew(['brand_name' => $this->newBrandName]);
            $brand->save();
            $this->warranty->brand_id = $brand->id;
        } else {
            $this->warranty->brand_id = $this->brandId;
        }
            
        $this->resetErrorBag();
        $this->resetValidation();

        if ($data['warrantyImage'] != null) {
            $imagePath = $data['warrantyImage']->storePublicly('public/warranties', 'local');
            Storage::disk('local')->delete('public/' . $this->warranty->receipt_url);
            $this->warranty->receipt_url = $imagePath;
        }

        $this->warranty->status = "Active";

        $this->warranty->save();
        $this->model->warranty_id = $this->warranty->id;
        $this->model->save();

        $this->warranty = new Warranty;

        return $this->redirect;
    }

    public function getModelProperty(){
        if( $this->model_category == "Computer" )
            return \App\Computer::find( $this->model_id );
        if( $this->model_category == "Component" )
            return \App\Component::find( $this->model_id );
        if( $this->model_category == "Peripheral" )
            return \App\Peripheral::find( $this->model_id );
    }

    public function getRedirectProperty(){
        if ($this->model_category == "Computer")
            return redirect()->to("/computers");
        if( $this->model_category == "Component" )
            return redirect()->to("/components");
        if( $this->model_category == "Peripheral" )
            return redirect()->to("/peripherals");
    }

    public function render()
    {
        return view('livewire.warranty-create', [
            'warranties' => Warranty::all(),
            'brands' => \App\Brand::all(),
        ]);
    }

}
