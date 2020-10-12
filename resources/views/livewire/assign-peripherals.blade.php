<div class="modal fade" id="assignPeripheralsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable w-75 mw-100" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Peripherals</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                @if( $isEditable )
                    {{ "[ ".implode( ",", $peripheralInd )." ] COUNT: ".count($peripheralInd)." CAN ADD MORE: " }}@if($this->canAdd) "YES" @else "NO" @endif
                    @for ($i = 0; $i < count($peripheralInd); $i++)
                    <div class="d-flex addRamStorage">
                        <select class="custom-select w-75" wire:model.lazy="peripheralInd.{{$i}}">
                            <option value="">Choose a peripheral.</option>
                            @foreach ( $this->availablePeripherals as $type => $groupedPeripherals )
                                <option disabled value="HEADER">
                                    {{ substr_replace( "------------------------------------------------------------------------------------------", \App\PeripheralType::find($type)->peripheral_type, 45 - ( strlen(\App\PeripheralType::find($type)->peripheral_type) / 2 ), strlen(\App\PeripheralType::find($type)->peripheral_type))}}
                                </option>
                                @foreach ( $groupedPeripherals->sortBy('asset_tag') as $per )
                                    <option value="{{$per->id}}">{{$per->asset_tag." - ".$per->peripheral_name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                        <button class="close w-25 ml-2" wire:click="removePeripheral({{$i}})">&times;</button>
                    </div>
                    @endfor
                    <div class="d-flex mt-2">
                        <button @if( !$this->canAdd ) disabled @endif class="btn btn-lg btn-success" style="width: 74% !important;" wire:click="addPeripheral()">Add a perpheral</button>
                        @if( !$this->canAdd )
                            <div class="alert alert-danger mb-0 ml-2" style="width: 24% !important;">
                                Choose a peripheral.
                            </div>
                        @endif
                    </div>
                @else
                    {{-- Just view the peripherals --}}
                    <table class="table">
                        <thead>
                            <th style="width: 15%;">Type</th>
                            <th>Asset Tag</th>
                            <th>Peripheral Name</th>
                        </thead>
                        <tbody>
                            @if( count($assign->peripherals) == 0 )
                                <tr><td colspan="3">No peripherals have been assigned.</td></tr>
                            @else
                                @foreach ($assign->peripherals->sortBy('peripheral_type') as $peripheral)
                                    <tr>
                                        <th>{{$peripheral->type->peripheral_type}}</th>
                                        <td>{{$peripheral->asset_tag}}</td>
                                        <td>{{$peripheral->peripheral_name}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="modal-footer align-items-center">
                @if( $isEditable )
                    <button class="btn btn-success" wire:click="toggleEdit">Cancel</button>
                    <button class="d-none btn btn-success" wire:click="toggleEdit">
                        Cancel
                    </button>
                    <button class="d-none"></button>
                    <button @if( !$this->canSave ) disabled @endif class="btn btn-success" wire:click="save">
                        Save
                    </button>
                @else
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