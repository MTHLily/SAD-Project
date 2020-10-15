<div>
<div class="modal fade" id="componentDetailsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Component Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="asset_tag" class="col-sm-3 col-form-label">Asset Tag</label>
                    <div class="col-sm-9">
                        <input  type="text" wire:model="component.asset_tag" placeholder="Asset Tag" 
                                    class="form-control @error('component.asset_tag') is-invalid @enderror" 
                                    @if(!$isEditable) disabled @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input  type="text"
                            class="form-control @error('component.component_name') is-invalid @enderror" wire:model="component.component_name"
                            @if(!$isEditable) disabled @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Type</label>
                    <div class="col-sm-9">
                        <select wire:model="component.component_type_id" class="custom-select" @if(!$isEditable) disabled @endif>
                        {{ $types = \App\ComponentType::all() }}
                        @foreach( $types as $type )
                            <option value="{{$type->id}}">{{$type->component_type}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <input  type="text" wire:model="component.status" placeholder="Status" 
                            class="form-control" 
                            disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="issues" class="col-sm-3 col-form-label">Issues</label>
                    <div class="col-sm-9">
                        <textarea  type="text" wire:model="component.issues" placeholder="Issues" 
                            class="form-control"
                            @if(!$isEditable) disabled @endif>
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
                    <div class="col-sm-9">
                        <textarea  type="text" wire:model="component.remarks" placeholder="Remarks" 
                            class="form-control"
                            @if(!$isEditable) disabled @endif>
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if( $isEditable )
                    <button class="d-none"></button>
                    <button class="btn btn-outline-danger" wire:click="toggleEdit">
                        <i class="fa fa-times" aria-hidden="true"></i> Cancel
                    </button>
                    <button class="d-none"></button>
                    <button class="btn btn-success" wire:click="save">
                        <i class="fas fa-save    "></i> Save
                    </button>
                @else
                    
                    <button class="btn btn-danger" data-target="#componentDeleteConfirmation" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    <button class="btn btn-outline-warning" wire:click="toggleEdit">
                        <i class="fa fa-edit" aria-hidden="true"></i> Update
                    </button>
                    <button class="btn btn-outline-success" data-dismiss="modal">
                        <i class="fa fa-check" aria-hidden="true"></i> OK
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="componentDeleteConfirmation" style="z-index: 2000;">
    <div class="modal-dialog mt-5" >
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title">Are you sure?</h4></div>
            <div class="modal-footer">
                <button class="btn btn-danger" wire:click="destroy">Yes</button>
                <button class="btn btn-success" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
</div>