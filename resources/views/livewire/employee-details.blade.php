<div>
<div class="modal fade" id="employeeDetailsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Employee Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="form-group w-75">
                        <label>Last Name<span class="text-danger">*</span></label>
                            <input required type="text" wire:model="emp.last_name" placeholder="Last Name" 
                                        class="form-control @error('emp.last_name') is-invalid @enderror" 
                                        @if(!$isEditable) disabled @endif>
                    </div>
                    <div class="form-group w-75">
                        <label>First Name<span class="text-danger">*</span></label>
                            <input required type="text"
                                class="form-control @error('emp.first_name') is-invalid @enderror" wire:model="emp.first_name"
                                @if(!$isEditable) disabled @endif>
                    </div>
                    <div class="form-group w-25">
                        <label >M.I.<span class="text-danger">*</span></label>
                            <input required type="text" wire:model="emp.middle_initial" placeholder="Middle Initial" 
                                class="form-control"
                                @if(!$isEditable) disabled @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="remarks" class="col-sm-3 col-form-label">Email Address<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input required type="text" wire:model="emp.email_address" placeholder="Email Address" 
                            class="form-control"
                            @if(!$isEditable) disabled @endif>
                    </div>
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <div class="d-flex">
                    @if( !$newDepartment )
                        <select wire:model="departmentId" class="custom-select w-75" @if(!$isEditable) disabled @endif>
                        {{ $types = \App\Department::all() }}
                        @foreach( $types as $type )
                            <option value="{{$type->id}}">{{$type->department_name}}</option>
                        @endforeach
                        </select>
                        <button class="btn btn-secondary ml-2 w-25" @if(!$isEditable) disabled @endif wire:click="toggleNewDepartment">Add New</button>
                    @else
                        <input wire:model="newDepartmentName" type="text" class="form-control w-75 @error('newDepartmentName') is-invalid @enderror" placeholder="New Department">
                        <button class="btn btn-secondary ml-2 w-25" wire:click="toggleNewDepartment">&times;</button>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <input  type="text" wire:model="emp.status" placeholder="Status" 
                            class="form-control" 
                            disabled>
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
                    
                    <button class="btn btn-danger" data-target="#employeeDeleteConfirmation" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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
<div class="modal fade" id="employeeDeleteConfirmation" style="z-index: 2000;">
    <div class="modal-dialog mt-5" >
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title">Are you sure you want to remove {{$emp->full_name()}}?</h4></div>
            <div class="modal-footer">
                <button class="btn btn-danger" wire:click="destroy">Yes</button>
                <button class="btn btn-outline-success" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
</div>