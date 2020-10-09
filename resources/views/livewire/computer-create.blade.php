<div class="modal fade" id="computerCreateModal" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-tit">Create Computer</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="asset_tag">Asset Tag</label>
                    <input type="text" class="form-control @error('computer.asset_tag') is-invalid @enderror" wire:model="computer.asset_tag">
                    @error('computer.asset_tag')
                        <div class="invalid-feed">
                            Please enter an asset tag.
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Computer Name</label>
                    <input type="text" class="form-control @error('computer.pc_name') is-invalid @enderror" wire:model="computer.pc_name">
                    @error('computer.pc_name')
                        <div class="invalid-feed">
                            Please enter a computer name.
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Type</label>
                    <select type="text" class="form-control" wire:model="computer.type">
                        @foreach ( $types as $type )
                            <option value="{{$type->id}}">{{$type->computer_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Department</label>
                    <div class="d-flex">
                        @if( !$newDepartment )
                            <select type="text" class="form-control" wire:model="existingDepartmentId">
                                <option>Don't assign a department</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
                            <button class="btn w-25 mr-2" wire:click="toggleNewDepartment">Add New</button>
                        @else
                            <input type="text" class="form-control @error('newDepartmentName') is-invalid  @enderror" placeholder="New Department" wire:model="newDepartmentName">
                            <button class="btn close w-25 mr-2" wire:click="toggleNewDepartment">&times;</button>
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
                        <textarea type="text" class="form-control" wire:model="computer.issues"></textarea>
                    </div>
                    <div class="form-group col">
                        <label for="notes">Remarks</label>
                        <textarea type="text" class="form-control" wire:model="computer.remarks"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn">
                    Cancel
                </button>
                <button class="btn" wire:click="save">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>