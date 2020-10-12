<div class="modal fade" id="assignmentCreateModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Employees</label>
                            <select class="form-control" wire:model="assign.employee_id">
                                <option value="0">Select an employee</option>
                                @foreach ( \App\Employee::where('status', 'Available' )->get() as $emp )
                                    <option value="{{$emp->id}}">{{$emp->full_name()}}</option>
                                @endforeach
                            </select>
                        </div>
                            <table class="table">
                                <tr>
                                    <th width="16%">Name</th>
                                    <td>
                                        @if($employee != null ){{$this->employee->full_name()}}@endif</td>
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
                            <select class="form-control" wire:model="assign.computer_id">
                                <option value="0">Select a computer</option>
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
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                <button type="button" class="btn btn-success" @if( !$this->canSave ) disabled @endif wire:click="save"><i class="fas fa-save    "></i> Add</button>
            </div>
        </div>
    </div>
</div>