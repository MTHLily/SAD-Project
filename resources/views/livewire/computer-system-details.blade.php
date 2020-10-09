<div class="modal fade" id="computerSystemDetailsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable w-75 mw-100" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Computer System Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                @if( !$isEditable)
                    <table class="table table-bordered">
                        <thead>
                            <th style="width: 20%;"></th>
                            <th style="width: 30%;">Asset Tag</th>
                            <th style="width: 50%;">Name</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Motherboard</th>
                                @if( $system->motherboard != null ) 
                                    <td>{{ $system->motherboard->asset_tag}}</td>
                                    <td>{{ $system->motherboard->component_name}}</td>
                                @else
                                    <td colspan="2">No Motherboard Assigned</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Processor</th>
                                @if($system->processor)
                                    <td>{{ $system->processor->asset_tag}}</td>
                                    <td>{{ $system->processor->component_name}}</td>
                                @else
                                    <td colspan="2">No Processor Assigned</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Graphics Card</th>
                                @if($system->gpu)
                                    <td>{{ $system->gpu->asset_tag}}</td>
                                    <td>{{ $system->gpu->component_name}}</td>
                                @else
                                    <td colspan="2">No Graphics Card Assigned</td>
                                @endif
                            </tr>
                            @if( $system->ram->count() != 0 )
                                @foreach( $system->ram as $ram )
                                    <tr>
                                        <th>RAM</th>
                                        <td>{{ $ram->component->asset_tag}}</td>
                                        <td>{{ $ram->component->component_name}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr >
                                    <th>RAM</th>
                                    <td colspan="2">No RAM Assigned</td>
                                </tr>
                            @endif
                            <tr>
                                <th>Operating System</th>
                                @if($system->operating_system) 
                                    <td colspan="2">{{ $system->operating_system->name}}</td>
                                @else
                                    <td colspan="2">No Operating System Assigned</td>
                                @endif                                    
                            </tr>
                            @if( $system->storage->count() != 0 )
                                @foreach( $system->storage as $storage )
                                    <tr>
                                        <th>Storage</th>
                                        <td>{{ $storage->component->asset_tag}}</td>
                                        <td>{{ $storage->component->component_name}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr >
                                    <th>Storage</th>
                                    <td colspan="2">No Storage Assigned</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                @else
                
                    <div class="form-group">
                      <label>Motherboard</label>
                      <select class="form-control" wire:model="system.motherboard_id">
                          <option>Select a motherboard</option>
                          @if( $system->motherboard != null )
                            <option value="{{$system->motherboard->id}}">{{$system->motherboard->asset_tag.' - '.$system->motherboard->component_name}}</option>
                          @endif

                          @foreach ( \App\Component::motherboards()->where( 'status', 'Available' )->get() as $component )
                              <option value="{{$component->id}}">{{$component->asset_tag.' - '.$component->component_name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="row">

                        <div class="form-group col">
                            <label>Processor</label>
                            <select class="form-control" wire:model="system.processor_id">
                                <option>Select a processor</option>
                                @if( $system->processor != null )
                                <option value="{{$system->processor->id}}">{{$system->processor->component_name}}</option>
                                @endif
                                
                                @foreach ( \App\Component::cpus()->where( 'status', 'Available' )->get() as $component )
                                <option value="{{$component->id}}">{{$component->asset_tag.' - '.$component->component_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group col">
                            <label>Graphics Card</label>
                            <select class="form-control" wire:model="system.gpu_id">
                                <option>Select a graphics card</option>
                                @if( $system->gpu != null )
                                <option value="{{$system->gpu->id}}">{{$system->gpu->component_name}}</option>
                                @endif
                                
                                @foreach ( \App\Component::gpus()->where( 'status', 'Available' )->get() as $component )
                                <option value="{{$component->id}}">{{$component->asset_tag.' - '.$component->component_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label>RAM</label>
                        <div class="d-flex flex-column">
                            @for ($i = 0; $i < $ramCount; $i++)
                            <div class="d-flex addRamStorage">
                                <select class="form-control" wire:model="rams.{{$i}}">
                                    <option value="0">Select a RAM card</option>
                                    @foreach ($this->availableRam as $component)
                                        <option value="{{$component->id}}">{{$component->asset_tag.' - '.$component->component_name}}</option>
                                    @endforeach
                                </select>
                                <button wire:click="removeRam({{$i}})" class="close w-25 ml-2">&times;</button>
                            </div>
                            @endfor
                            {{-- {{ "[ ".implode(",", $this->rams)." ] ".$canAddRam." RAM COUNT: ".$ramCount}} --}}
                            <button @if( !$canAddRam ) disabled @endif class="btn btn-success mt-2" wire:click="addRamCount">Add More RAM</button>
                        </div>
                    </div>

                    <div class="form-group">
                      <label>Operating System</label>
                      <select class="form-control" wire:model="system.operating_system_id">
                          <option>Select an operating system</option>
                          @foreach ( \App\OperatingSystem::all() as $os )
                              <option value="{{$os->id}}">{{$os->name}}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Storage</label>
                      <div class="d-flex flex-column">
                            @for ($i = 0; $i < $storageCount; $i++)
                            <div class="d-flex addRamStorage">
                                <select class="form-control" wire:model="storages.{{$i}}">
                                    <option value="0">Select storage</option>
                                    @foreach ($this->availableStorage as $component)
                                        <option value="{{$component->id}}">{{$component->asset_tag.' - '.$component->component_name}}</option>
                                    @endforeach
                                </select>
                                <button wire:click="removeStorage({{$i}})" class="close w-25 ml-2">&times;</button>
                            </div>
                            @endfor
                            {{-- {{ "[ ".implode(",", $this->storages)." ] ".$canAddStorage." STORAGE COUNT: ".$storageCount}} --}}
                            <button @if( !$canAddStorage ) disabled @endif class="btn btn-success mt-2" wire:click="addStorageCount">Add More Storage</button>
                        </div>
                    </div>
                    </script>
                @endif
            </div>
            <div class="modal-footer">
                @if($isEditable)
                    <button type="button" class="btn btn-secondary" wire:click="toggleEdit">Cancel</button>
                    <button type="button" class="d-none" wire:click="toggleEdit">Cancel</button>
                    <button type="button" class="d-none" wire:click="save">Save</button>
                    <button type="button" class="btn btn-primary" @if( !$this->canSave ) disabled @endif wire:click="save">Save</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="toggleEdit">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                @endif
            </div>
        </div>
    </div>
</div>
