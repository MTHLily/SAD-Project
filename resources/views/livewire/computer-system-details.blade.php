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
                                @if($system->motherboard) 
                                    <td>{{ $system->motherboard->asset_tag}}</td>
                                    <td>{{ $system->motherboard->component_name}}</td>
                                @else
                                    <td colspan="2">No Motherboard Assigned</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Processor</th>
                                <td>@if($system->processor) {{ $system->processor->asset_tag}}@endif</td>
                                <td>@if($system->processor) {{ $system->processor->component_name}}@endif</td>
                            </tr>
                            <tr>
                                <th>Graphics Card</th>
                                <td>@if($system->gpu) {{ $system->gpu->asset_tag}}@endif</td>
                                <td>@if($system->gpu) {{ $system->gpu->component_name}}@endif</td>
                            </tr>
                            @if( $system->ram->count() != 0 )
                                @foreach( $system->ram as $ram )
                                    <tr>
                                        <th>RAM</th>
                                        <td>{{ $ram->asset_tag}}</td>
                                        <td>{{ $ram->component_name}}</td>
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
                                <td colspan="2">@if($system->operating_system_id) {{ $system->operating_system->name}}@endif</td>
                            </tr>
                            @if( $system->storage->count() != 0 )
                                @foreach( $system->storage as $storage )
                                    <tr>
                                        <th>Storage</th>
                                        <td>{{ $storage->asset_tag}}</td>
                                        <td>{{ $storage->component_name}}</td>
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
                    {{-- <h4>Motherboard</h4>
                    <table class="table componentTable table-bordered">
                        <thead>
                            <th>Asset Tag</th>
                            <th>Motherboard</th>
                        </thead>
                        <tbody>
                            @foreach ( \App\Component::motherboards()->where('status', 'Available')->get() as $component )
                                <tr>
                                    <td>{{$component->asset_tag}}</td>
                                    <td>{{$component->component_name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <h4>Processor</h4>
                    <table class="table componentTable table-bordered">
                        <thead>
                            <th>Asset Tag</th>
                            <th>Processor</th>
                        </thead>
                        <tbody>
                            @foreach ( \App\Component::cpus()->where('status', 'Available')->get() as $component )
                                <tr>
                                    <td>{{$component->asset_tag}}</td>
                                    <td>{{$component->component_name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <h4>Graphics Card</h4>
                    <table class="table componentTable table-bordered">
                        <thead>
                            <th>Asset Tag</th>
                            <th>Graphics Card</th>
                        </thead>
                        <tbody>
                            @foreach ( \App\Component::gpus()->where('status', 'Available')->get() as $component )
                                <tr>
                                    <td>{{$component->asset_tag}}</td>
                                    <td>{{$component->component_name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <h4>RAM</h4>
                    <table class="table componentTable table-bordered">
                        <thead>
                            <th>Asset Tag</th>
                            <th>RAM</th>
                        </thead>
                        <tbody>
                            @foreach ( \App\Component::rams()->where('status', 'Available')->get() as $component )
                                <tr>
                                    <td>{{$component->asset_tag}}</td>
                                    <td>{{$component->component_name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                    
                    <h4>Operating System</h4>
                    <table class="table" id="osTable">
                        <thead>
                            <th>Operating System</th>
                        </thead>
                        <tbody>
                            @foreach ( \App\OperatingSystem::all() as $os)
                                <tr>
                                    <td>{{$os->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <h4>Storage</h4>
                    <table class="table componentTable table-bordered">
                        <thead>
                            <th>Asset Tag</th>
                            <th>Storage</th>
                        </thead>
                        <tbody>
                            @foreach ( \App\Component::storages()->where('status', 'Available')->get() as $component )
                                <tr>
                                    <td>{{$component->asset_tag}}</td>
                                    <td>{{$component->component_name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table> --}}
                @endif
            </div>
            <div class="modal-footer">
                @if($isEditable)
                    <button type="button" class="btn btn-secondary" wire:click="toggleEdit">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="toggleEdit">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                @endif
            </div>
        </div>
    </div>
</div>