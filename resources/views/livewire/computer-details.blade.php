<div>
<div class="modal fade" id="computerDetailsModal" wire:ignore.self style="z-index: 1400;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-tit">Computer Details</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="asset_tag">Asset Tag</label>
                    <input @if(!$isEditable) disabled @endif type="text" class="form-control @error('computer.asset_tag') is-invalid @enderror" wire:model="computer.asset_tag">
                    @error('computer.asset_tag')
                        <div class="invalid-feed">
                            Please enter an asset tag.
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Computer Name</label>
                    <input @if(!$isEditable) disabled @endif type="text" class="form-control @error('computer.pc_name') is-invalid @enderror" wire:model="computer.pc_name">
                    @error('computer.pc_name')
                        <div class="invalid-feed">
                            Please enter a computer name.
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Type</label>
                    <select @if(!$isEditable) disabled @endif type="text" class="form-control" wire:model="computer.type">
                        @foreach ( $types as $type )
                            <option value="{{$type->id}}">{{$type->computer_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Department</label>
                    <div class="d-flex">
                        @if( !$newDepartment )
                            <select type="text" @if(!$isEditable) disabled @endif class="form-control w-100" wire:model="existingDepartmentId">
                                <option>Don't assign a department</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-success w-25 ml-2" @if(!$isEditable) disabled @endif wire:click="toggleNewDepartment">Add New</button>
                        @else
                            <input type="text" class="form-control w-100 @error('newDepartmentName') is-invalid  @enderror" placeholder="New Department" wire:model="newDepartmentName">
                            <button class="btn btn-success close w-25 ml-2" wire:click="toggleNewDepartment">&times;</button>
                            @error('newDepartmentName')
                                <div class="invalid-feed">
                                    Please enter a department name.
                                </div>
                            @enderror
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="issues">Issues</label>
                        <textarea @if(!$isEditable) disabled @endif type="text" class="form-control" wire:model="computer.issues"></textarea>
                    </div>
                    <div class="form-group col">
                        <label for="notes">Remarks</label>
                        <textarea @if(!$isEditable) disabled @endif type="text" class="form-control" wire:model="computer.remarks"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if( $isEditable )
                    <button class="d-none"></button>
                    <button class="btn btn-success" wire:click="toggleEdit">
                        Cancel
                    </button>
                    <button class="d-none"></button>
                    <button class="btn btn-success" wire:click="save">
                        Save
                    </button>
                @else
                    
                    <button class="btn btn-success" data-target="#computerDeleteConfirmation" data-toggle="modal">Delete</button>
                    <button class="btn btn-success" wire:click="toggleEdit">
                        Update
                    </button>
                    <button class="btn btn-success" data-dismiss="modal">
                        OK
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="computerDeleteConfirmation" style="z-index: 2000;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-header"><h4 class="modal-title">Are you sure?</h4></div>
            <div class="modal-footer">
                <button class="btn btn-success" wire:click="destroy">Yes</button>
                <button class="btn btn-success" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
</div>