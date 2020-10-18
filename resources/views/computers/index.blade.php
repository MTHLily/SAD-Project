@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>

{{-- JQuery Import for Javascript --}}
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script> --}}


<script src=" {{asset('js/computer.js')}}"></script>

@endpush

@push('styles')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"> --}}

<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@livewireStyles
@endpush

@section('content')

@livewire('warranty-create')
@livewire('warranty-details', [ 'model' => 'Computer'])
@livewire('computer-create')
@livewire('computer-details')
@livewire('computer-system-details')

<div class="container">
	<div class="d-flex justify-content-between">
		<h2>Computer Inventory</h2>
		</form>
		<div class="d-flex form-inline">
			<button class="btn btn-success" data-toggle="modal" data-target="#computerCreateModal"><i class="fas fa-plus"></i> Add Computer</button>
			<input type="text" class="form-control ml-2" id="searchBox" placeholder="Search">
		</div>
	</div>

	<table class="table table-striped table-bordered dataTable mb-5">
		<thead>
			<th>ASSET TAG</th>
			<th>PC NAME</th>
			<th>TYPE</th>
			<th>DEPARTMENT</th>
			<th>SYSTEM</th>
			<th>NETWORK</th>
			<th>WARRANTY</th>
			<th>STATUS</th>
			<th>DETAILS</th>
		</thead>
		<tbody>
			@foreach( $computers as $computer )
				<tr>
				<td>{{ $computer->asset_tag }}</td>
					<td class="name">{{ $computer->pc_name }}</td>
					<td>{{ $computer->typeName->computer_type }}</td>
					<td>@if($computer->department != null ){{ $computer->department->department_name }}@endif</td>
					<td class="system">
						@if($computer->system_details_id != null)
							@if( $computer->systemDetails->isComplete() )
								<a href="#" onclick="showComputerSystemDetails( {{$computer->id }})"><i class="fas fa-server" aria-hidden="true"></i> View System Details</a>
							@else
								<a class="warning-yellow" href="#" onclick="showComputerSystemDetails( {{$computer->id }})"><i class="fas fa-server"></i> System Details Incomplete</a>
							@endif
						@else
							<a href="#" class="danger-red" onclick="showComputerSystemDetails( {{$computer->id }})"><i class="fas fa-server    "></i> Assign System Details</a>
						@endif
					</td>
					<td>
						@if( $computer->network_details_id != null) 
							<div class="modal fade" id="network_modal_{{$computer->id}}_modify">
								<div class="modal-dialog">
									<div class="modal-content">

										<div class="modal-header">
											<h4 class="modal-title">Modify Network Details</h4>
											<button class='close' data-dismiss='modal'>&times</button>;
										</div>

										<form action="/computers/edit_network_details/{{$computer->network_details_id}}" method="POST">
											@csrf
											@method('PATCH')
											<div class="modal-body">
												<div class="form-group">
													<label for="mac_address">MAC Address</label>
													<input class="form-control" value="{{$computer->networkDetails->mac_address}}" type="text" name="mac_address" required> 
												</div>
												<div class="form-group">
													<label for="wifi_address">Wi-Fi Address</label>
													<input class="form-control" value="{{$computer->networkDetails->wifi_address}}" type="text" name="wifi_address" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" data-dismiss="modal" class="btn btn-outline-danger">
													<i class="fa fa-times" aria-hidden="true"></i> Cancel
												</button>
												<button class="btn btn-success">
													<i class="fas fa-edit    "></i> Update
												</button>
											</div>
										</form>

									</div>
								</div>
							</div>
							<a data-toggle="modal" href="#network_modal_{{$computer->id}}_modify"><i class="fas fa-network-wired    "></i> View Network Details</button>
						@else
							<div class="modal fade" id="network_modal_{{$computer->id}}">
								<div class="modal-dialog">
									<div class="modal-content">

										<div class="modal-header">
											<h4 class="modal-title">Assign Network Details</h4>
											<button class='close' data-dismiss='modal'>&times</button>;
										</div>

										<form action="/computers/assign_network_details/{{$computer->id}}" method="POST">
											@csrf
											<div class="modal-body">
												<div class="form-group">
													<label for="mac_address">MAC Address</label>
													<input class="form-control" type="text" name="mac_address" required> 
												</div>
												<div class="form-group">
													<label for="wifi_address">Wi-Fi Address</label>
													<input class="form-control" type="text" name="wifi_address" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" data-dismiss="modal" class="btn btn-outline-danger">
													<i class="fa fa-times" aria-hidden="true"></i> Cancel
												</button>
												<button class="btn btn-success">
													<i class="fas fa-save    "></i> Assign
												</button>
											</div>
										</form>

									</div>
								</div>
							</div>
							<a class="warning-yellow" data-toggle="modal" href="#network_modal_{{$computer->id}}"><i class="fas fa-network-wired    "></i> Assign Network Details</button>
						@endif
				    </td>
					<td class="warranty">
						@if($computer->warranty_id != null)
							<span onclick="getWarrantyInfo({{$computer->warranty_id}})"><i class="fas fa-receipt    "></i> View Warranty</span>
						@else
							<span class="danger-red" onclick="showWarrantyCreate( 'Computer', {{$computer->id}} )"><i class="fas fa-receipt" aria-hidden="true"></i> Assign Warranty</span>
						@endif
					</td>
					<td>
                            <span class=
                                @if($computer->status=='Assigned') 
                                    "text-danger"
                                @else
                                    "text-success"
                                @endif
                                >{{$computer->status}}</span></td>
					<td class="detail">
						<a href="#" onclick="getComputerInfo({{$computer->id}})"><i class="fa fa-info-circle" aria-hidden="true"></i> View Details</a>
					</td>  
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<script src=" {{asset('js/crud.js')}}"></script>
@livewireScripts
@endsection