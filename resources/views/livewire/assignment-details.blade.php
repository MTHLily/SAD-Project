<div>
<div class="modal fade" id="assignmentDetailsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Employees</label>
                            <select class="form-control" wire:model="assign.employee_id" @if( !$isEditable ) disabled @endif>
                                @if( $assign->employee != null )<option value="{{$assign->employee->id}}">{{$assign->employee->full_name()}}</option> @endif
                                @foreach ( \App\Employee::where('status', 'Available' )->get() as $emp )
                                    <option value="{{$emp->id}}">{{$emp->full_name()}}</option>
                                @endforeach
                            </select>
                        </div>
                            <table class="table">
                                <tr>
                                    <th width="16%">Name</th>
                                    <td>@if($employee != null ){{$employee->full_name()}}@endif</td>
                                </tr>
                                <tr>
                                    <th>Email Address</th>
                                    <td>@if($employee != null ){{$employee->email_address}}@endif</td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>@if($employee != null && $employee->department_id != null ){{$employee->department->department_name}}@endif</td>
                                </tr>
                            </table>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Computers</label>
                            <select class="form-control" wire:model="assign.computer_id" @if( !$isEditable ) disabled @endif>
                                @if( $assign->computer != null )<option value="{{$assign->computer->id}}">{{$assign->computer->pc_name}}</option> @endif
                                @foreach ( \App\Computer::where('status', 'Available' )->get() as $com )
                                    <option value="{{$com->id}}">{{$com->pc_name}}</option>
                                @endforeach
                            </select>
                        </div>
                            <table class="table">
                                <tr>
                                    <th width="16%">PC Name</th>
                                    <td>@if( $computer != null ) {{$computer->pc_name}} @endif</td>
                                </tr>
                                <tr>
                                    <th>Asset Tag</th>
                                    <td>@if( $computer != null ) {{$computer->asset_tag}} @endif</td>
                                </tr>
                                <tr>
                                    <th class="th_clickable" colspan="2" @if( $computer != null && $computer->id != null ) onclick="getComputerInfo({{$computer->id}})" @endif><i class="fa fa-info-circle" aria-hidden="true"></i> Details</th>
                                </tr>
                                <tr>
                                    
                                    @if( $computer != null && $computer->id != null )
                                        <th class="th_clickable" colspan="2"  onclick="showComputerSystemDetails({{$computer->id}})">
                                            @if( $computer->systemDetails != null && $computer->systemDetails->isComplete() )
                                                <i class="fa fa-info-circle" aria-hidden="true"></i> System Details
                                            @else
                                                <span class="danger-red-light"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> System Lacking Components</span>
                                            @endif
                                        </th>
                                    @else
                                        <th class="th_clickable" colspan="2">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i> System Details
                                        </th>
                                    @endif
                                </tr>
                            </table>
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
                    
                    <button class="btn btn-danger" data-target="#assignmentDeleteConfirmation" data-toggle="modal"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    <button class="btn btn-outline-warning" wire:click="toggleEdit">
                        <i class="fa fa-upload" aria-hidden="true"></i> Update
                    </button>
                    <button class="btn btn-outline-success" data-dismiss="modal">
                        <i class="fa fa-check" aria-hidden="true"></i> OK
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="assignmentDeleteConfirmation" style="z-index: 2000;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >
            <div class="modal-header"><h4 class="modal-title">Are you sure?</h4></div>
            <div class="modal-footer">
                <button class="btn btn-success" wire:click="destroyAssignment">Yes</button>
                <button class="btn btn-success" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
</div>