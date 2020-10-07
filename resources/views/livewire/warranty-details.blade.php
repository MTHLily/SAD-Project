<div class="modal" id="warrantyDetailsModal" wire:ignore.self>
    <div class="modal-dialog w-75 mw-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Warranty Details
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="brand_id" class="col-sm-3 col-form-label">Brand</label>
                    <div class="col-sm-9 d-flex">
                        <div class=" @if( $newBrand ) d-none @else d-flex @endif w-100 align-items-center">
                            <select name="brand_id" @if(!$isEditable) disabled @endif type="text" class="form-control" wire:model="brand_id"">
                                @foreach ( $brands as $brand )
                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                            <button @if(!$isEditable) disabled @endif class="btn btn-primary h-100 w-25 ml-3" wire:click="toggleNewBrand">Add New</button>
                        </div>
                        <div class="w-100 @if(!$newBrand) d-none @else d-flex @endif" id="new_department_div">
                            <input wire:model="newBrandName" name="new_brand" @if(!$newBrand) disabled @endif @if(!$isEditable) disabled @endif placeholder="New Brand" type="text" class="form-control">
                            <button type="button" class="close w-25 ml-3" wire:click="toggleNewBrand">&times;</button>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="purchase_date">Purchase Date</label>
                        <input name="purchase_date" @if(!$isEditable) disabled @endif type="date" class="form-control" wire:model="purchase"">
                    </div>
                    <div class="form-group col">
                        <label for="purchase_location">Purchase Location</label>
                        <input name="purchase_location" @if(!$isEditable) disabled @endif type="text"class="form-control" wire:model="warranty.purchase_location">
                    </div>
                    <div class="form-group col" >
                        <label for="warranty_life">End of Warranty</label>
                        <input name="warranty_life" @if(!$isEditable) disabled @endif type="date"class="form-control" wire:model="life"">
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col">
                        <label for="receipt_url">Receipt</label>
                        <div class="custom-file d-flex align-items-center justify-content-center">
                            @if( !$isEditable )
                            <a href="storage/{{ str_replace( "public/", "", ($warranty->receipt_url))}}" id="receipt_url"><h4>See Receipt</h4></a>
                            @else
                            <label class="custom-file-label" for="receipt_url">Choose file</label>
                            <input name="receipt_url" type="file" class="custom-file-input" wire:model="warrantyImage">
                            @endif
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="serial_no">Serial No.</label>
                            <input name="serial_no" @if(!$isEditable) disabled @endif type="text"class="form-control" wire:model="warranty.serial_no">
                    </div>

                </div>
                <div class="form-group row">
                    <label for="notes" class="col-sm-3 col-form-label">Notes</label>
                    <div class="col-sm-9">
                        <textarea name="notes" @if(!$isEditable) disabled @endif type="text"class="form-control" wire:model="warranty.notes">
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <input name="status" disabled type="text"class="form-control" wire:model="warranty.status">
                    </div>
                </div>
                @if( $warranty->computer->count() != 0 )
                <div id="computerTable" class="pt-2">
                    <table class="table">
                        <thead>
                            <th>ASSET TAG</th>
                            <th>COMPUTER NAME</th>
                            <th>STATUS</th>
                        </thead>
                        <tbody>
                            @foreach ($warranty->computer as $computer)
                                <tr>
                                    <td>{{$computer->asset_tag}}</td>
                                    <td>{{$computer->pc_name}}</td>
                                    <td>{{$computer->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @if( $warranty->component->count() != 0 )
                <div id="componentTable" class="pt-2">
                    <table class="table">
                        <thead>
                            <th>ASSET TAG</th>
                            <th>COMPONENT NAME</th>
                            <th>STATUS</th>
                        </thead>
                        <tbody>
                            @foreach ($warranty->component as $component)
                                <tr>
                                    <td>{{$component->asset_tag}}</td>
                                    <td>{{$component->component_name}}</td>
                                    <td>{{$component->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                @if( $warranty->peripheral->count() != 0 )
                <div id="peripheralTable" class="pt-2">
                    <table class="table">
                        <thead>
                            <th>ASSET TAG</th>
                            <th>PERIPHERAL NAME</th>
                            <th>STATUS</th>
                        </thead>
                        <tbody>
                            @foreach ($warranty->peripheral as $peripheral)
                                <tr>
                                    <td>{{$peripheral->asset_tag}}</td>
                                    <td>{{$peripheral->peripheral_name}}</td>
                                    <td>{{$peripheral->status}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                @if( $isEditable )
                    <button class="btn btn-success" type="button" wire:click="toggleEdit">Cancel</button>
                    <button class="btn btn-success d-none" type="button" wire:click="save"></button>
                    <button class="btn btn-success" type="button" wire:click="save">Save</button>
                @else
                    <button class="btn btn-success" type="button" wire:click="toggleEdit">Update</button>
                    <button class="btn btn-success" type="button" data-dismiss="modal">OK</button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
</script>