<div class="modal" id="warrantyCreateModal" wire:ignore.self>
    <div class="modal-dialog w-75 mw-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Assign Warranty
            </div>
            <div class="modal-body">
                {{-- <div class="card">
                    <div class="card-header" id="oldWarrantyHeading">
                        <h4><button data-toggle="collapse" data-target="#oldWarrantyDiv" aria-expanded="true" aria-controls="oldWarrantyDiv" class="btn btn-link" style="background:rgba(0,0,0,0);">Select From Warranties</button></h4>
                    </div>
                </div> --}}
                <table class="table table-striped table-bordered mb-0">
                    <thead id="oldWarrantyHeading">
                        <th data-toggle="collapse" data-target="#oldWarrantyDiv" aria-expanded="hide" aria-controls="oldWarrantyDiv">
                            Select From Existing Warranties
                        </th>
                    </thead>
                </table>
                <div id="oldWarrantyDiv" class="collapse" aria-labelledby="oldWarrantyHeading" data-parent="#warrantyCreateModal div div .modal-body">
                    <div class="d-flex flex-column align-items-center justify-content-center m-2">
                        <table class="table" id="warrantySelectTable">
                            <thead>
                                <th>Purchase Date</th>
                                <th>Warranty End Date</th>
                                <th>Notes</th>
                            </thead>
                            <tbody>
                                @foreach ($warranties as $warranty)
                                    <tr data-warranty-id="{{$warranty->id}}">
                                        <td>{{$warranty->purchase_date->format('Y-m-d')}}</td>
                                        <td>{{$warranty->warranty_life->format('Y-m-d')}}</td>
                                        <td>{{$warranty->notes}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="text" wire:model="selectedWarranty" id="selectedWarranty">
                    </div>
                </table>
                </div>
                <table class="table table-striped table-bordered">
                    <thead id="oldWarrantyHeading">
                        <th data-toggle="collapse" data-target="#newWarrantyDiv" aria-expanded="show" aria-controls="newWarrantyDiv">Create New Warranty</th>
                    </thead>
                </table>
                <div id="newWarrantyDiv" class="collapse show" aria-labelledby="newWarrantyHeading" data-parent="#warrantyCreateModal div div .modal-body">
                    <div class="form-group row">
                        <label for="brand_id" class="col-sm-3 col-form-label">Brand</label>
                        <div class="col-sm-9 d-flex">
                            <div class=" @if( $newBrand ) d-none @else d-flex @endif w-100 align-items-center">
                                <select name="brand_id" type="text" class="form-control @error('brandId') is-invalid @enderror" wire:model="brandId">
                                    <option >Choose a brand</option>
                                    @foreach ( $brands as $brand )
                                        <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary h-100 w-25 ml-3" wire:click="toggleNewBrand">Add New</button>
                            </div>
                            <div class="w-100 @if(!$newBrand) d-none @else d-flex @endif" id="new_department_div">
                                <input wire:model="newBrandName" name="new_brand" @if(!$newBrand) disabled @endif placeholder="New Brand" type="text" class="form-control">
                                <button type="button" class="close w-25 ml-3" wire:click="toggleNewBrand">&times;</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="purchase_date">Purchase Date</label>
                            <input name="purchase_date" type="date" class="form-control" wire:model="purchase"">
                        </div>
                        <div class="form-group col">
                            <label for="purchase_location">Purchase Location</label>
                            <input name="purchase_location" type="text"class="form-control @error('warranty.purchase_location') is-invalid @enderror" wire:model="warranty.purchase_location">
                            @error('warranty.purchase_location')
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col" >
                            <label for="warranty_life">End of Warranty</label>
                            <input name="warranty_life" type="date"class="form-control" wire:model="life"">
                        </div>
                    </div>
                    <div class="form-row">
                        
                        <div class="form-group col">
                            <label for="receipt_url">Receipt</label>
                            <div class="custom-file d-flex align-items-center justify-content-center is-invalid">
                                <label class="custom-file-label" for="receipt_url">Choose file</label>
                                <input name="receipt_url" type="file" class="custom-file-input" wire:model="warrantyImage">
                            </div>
                            @error('warrantyImage')
                            <div class="invalid-feedback">
                                Please provide a valid image.
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col">
                            <label for="serial_no">Serial No.</label>
                            <input name="serial_no" type="text"class="form-control" wire:model="warranty.serial_no">
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="notes" class="col-sm-3 col-form-label">Notes</label>
                        <div class="col-sm-9">
                            <textarea name="notes" type="text"class="form-control" wire:model="warranty.notes">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn" onclick="warrantySave()">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function warrantySave(){

    let assign = document.querySelector('#oldWarrantyDiv').classList.contains("show");
    let create = document.querySelector('#newWarrantyDiv').classList.contains("show");
    console.log(assign);
    //Select from existing warranties
    if( assign ){
        Livewire.emit('assignWarranty', document.querySelector('#selectedWarranty').value );
    }
    //Create new warranty
    if( create ){
        Livewire.emit('createWarranty');
    }

}

</script>