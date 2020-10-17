<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Warranty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class WarrantyDetails extends Component
{

    use WithFileUploads;

    // public $brand_id, $purchase_date, $purchase_location, $receipt_url, $serial_no, $warranty_life, $notes, $status;
    public Warranty $warranty;
    public $isEditable = false, $newBrand = false;
    public $purchase, $life, $warrantyImage, $newBrandName, $brand_id, $model;

    protected $rules = [
        'warranty.purchase_date' => '',
        'warranty.purchase_location' => 'required',
        'warranty.receipt_url' => '',
        'warranty.serial_no' => '',
        'warranty.warranty_life' => '',
        'warranty.notes' => '',
        'warranty.status' => '',
    ];

    protected $listeners = [
        'showWarrantyDetails' => 'showDetails',
        'refreshComponent' => '$refresh',
    ];

    public function mount( $model ){
        $this->warranty = new Warranty;
        $this->model = $model;
        // dd($this->model);
    }

    public function updatedWarrantyImage(){
        $this->validate([
            'warrantyImage' => 'image',
        ]);
    }

    public function showDetails( $id ){

        $this->warranty = Warranty::find($id);
        $this->brand_id = $this->warranty->brand_id;
        $this->purchase = $this->warranty->purchase_date->format('Y-m-d');
        $this->life = $this->warranty->warranty_life->format('Y-m-d');

        $this->isEditable = false;

        $this->dispatchBrowserEvent( 'show-warranty-details' );
    }

    public function toggleEdit()
    {
        $this->warranty = $this->warranty->fresh();
        $this->isEditable = !$this->isEditable;
    }

    public function toggleNewBrand(){
        $this->newBrand = !$this->newBrand;
    }

    public function getRedirectProperty()
    {
        if ($this->model == "Computer")
        return redirect()->to("/computers");
        if ($this->model == "Component")
        return redirect()->to("/components");
        if ($this->model == "Peripheral")
        return redirect()->to("/peripherals");
        if ($this->model == "Warranty")
        return redirect()->to("/warranties");
    }

    public function render()
    {
        return view('livewire.warranty-details', ['brands' => \App\Brand::all() ]);
    }

    public function save(){

        // $this->isEditable = !$this->isEditable;
        // dd($this->warrantyImage);
        $data = $this->validate([
            'warrantyImage' => '',
            'warranty.purchase_location' => 'required',
        ]);

        
        if( $data['warrantyImage'] != null ){
            $imagePath = $data['warrantyImage']->storePublicly('public/warranties', 'local');
            Storage::disk('local')->delete('public/' . $this->warranty->receipt_url );
            $this->warranty->receipt_url = $imagePath;
        }
        
        $this->warranty->purchase_date = Carbon::createFromFormat( 'Y-m-d' ,$this->purchase);
        $this->warranty->warranty_life = Carbon::createFromFormat( 'Y-m-d' ,$this->life);
        
        if( $this->warranty->warranty_life->gt( Carbon::now() ) )
            $this->warranty->status = "Active";
        else
            $this->warranty->status = "Expired";

        if( $this->newBrand ){
            $brand = \App\Brand::firstOrNew(['brand_name' => $this->newBrandName ]);
            $brand->save();
            $this->warranty->brand_id = $brand->id;    
        }
        else{
            $this->warranty->brand_id = $this->brand_id;
        }
        
        // dd( $data );
        $this->warranty->save();
        
        return $this->redirect;

        $this->isEditable = false;
        $this->emitSelf('refreshComponent');

    }

    public function destroy(){
        $products = $this->warranty->products();

        foreach( $products as $product ){
            $product->warranty_id = null;
            $product->save();
        }

        $this->warranty->delete();

        return $this->redirect;

    }

}
