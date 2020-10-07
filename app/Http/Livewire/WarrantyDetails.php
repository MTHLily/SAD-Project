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
    public $purchase, $life, $warrantyImage, $newBrandName, $brand_id;

    protected $rules = [
        'warranty.purchase_date' => '',
        'warranty.purchase_location' => 'required',
        'warranty.receipt_url' => '',
        'warranty.serial_no' => '',
        'warranty.warranty_life' => '',
        'warranty.notes' => '',
        'warranty.status' => '',
    ];

    protected $listeners = ['showWarrantyDetails' => 'showDetails'];

    public function mount(){
        $this->warranty = Warranty::find(1);
    }

    public function showDetails( $id ){

        $this->warranty = Warranty::find($id)[0];
        $this->brand_id = $this->warranty->brand_id;
        $this->purchase = $this->warranty->purchase_date->format('Y-m-d');
        $this->life = $this->warranty->warranty_life->format('Y-m-d');

    }

    public function toggleEdit()
    {
        $this->warranty = $this->warranty->fresh();
        $this->isEditable = !$this->isEditable;
    }

    public function toggleNewBrand(){
        $this->newBrand = !$this->newBrand;
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
        ]);

        // dd( $data );

        if( $data['warrantyImage'] != null ){
            $imagePath = $data['warrantyImage']->storePublicly('public/warranties', 'local');
            Storage::disk('local')->delete('public/' . $this->warranty->receipt_url );
            $this->warranty->receipt_url = $imagePath;
        }

        $this->warranty->purchase_date = Carbon::createFromFormat( 'Y-m-d' ,$this->purchase);
        $this->warranty->warranty_life = Carbon::createFromFormat( 'Y-m-d' ,$this->life);

        if( $this->newBrand ){
            $brand = \App\Brand::firstOrNew(['brand_name' => $this->newBrandName ]);
            $brand->save();
            $this->warranty->brand_id = $brand->id;    
        }
        else{
            $this->warranty->brand_id = $this->brand_id;
        }
        $this->warranty->save();
        
        return redirect()->to('/warranties');

    }

}
