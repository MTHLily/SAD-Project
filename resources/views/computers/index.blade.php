@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>

{{-- JQuery Import for Javascript --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12">
			<form class="form-inline float-sm-left">
				<div class="form-group mr-2">
					<h1>Computer Inventory</h1>
				</div>
			</form>
			<form class="form-inline float-sm-right">
				<a href="/computers/create" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Add Item</a>
				<input type="text" class="form-control ml-2" id="searchBox" placeholder="Search">
			</form>
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
			<th>ITEM DETAILS</th>
		</thead>
		<tbody>
			@foreach( $computers as $computer )
				<tr>
				<td>{{ $computer->asset_tag }}</td>
					<td class="name">{{ $computer->pc_name }}</td>
					<td>{{ $computer->type()->get()[0]->computer_type }}</td>
					<td>{{ $computer->department_id }}</td>
					<td class="system">
						@if($computer->system_details_id != null)
							<a href="/computers/system_details/{{ $computer->system_details_id }}">View System Details</a>
						@else
							<a href="/computers/create_system_details/{{$computer->id}}">Assign System Details</a>
						@endif
					</td>
					<td>
						@if( $computer->network_details_id != null) 
						{{-- View Details Here --}}
						{{-- Below is form for updating network details --}}
						{{-- <form action="/computers/edit_network_details/{{$computer->network_details_id}}" method="POST">
							@method('PATCH')
							@csrf
							<input placeholder="MAC Address" name="mac_address" required> 
												<input placeholder="WiFi Address" name="wifi_address" required>
						</form> --}}
							MAC: {{$computer->networkDetails->get()[0]->mac_address}}
							WIFI: {{$computer->networkDetails->get()[0]->wifi_address}}
						@else
							<div class="modal" id="network_modal_{{$computer->id}}">
								<div class="modal-dialog">
									<div class="modal-content">

										<div class="modal-header">
											<h4 class="modal-title">Assign Network Details</h4>
										</div>

										<form action="/computers/assign_network_details/{{$computer->id}}" method="POST">
											@csrf
											<div class="modal-body">
												<input placeholder="MAC Address" name="mac_address" required> 
												<input placeholder="WiFi Address" name="wifi_address" required>
											</div>
											<div class="modal-footer">
												<button type="button" data-dismiss="modal" class="btn">
													Cancel
												</button>
												<button class="btn btn-primary">
													Assign
												</button>
											</div>
										</form>

									</div>
								</div>
							</div>
							<a data-toggle="modal" href="#network_modal_{{$computer->id}}">Assign Network Details</button>
						@endif
				    </td>
					<td class="warranty">
						{!! ($computer->warranty_id != null) ? 
								"<a href='/warranties/$computer->warranty_id'>View Warranty</a>" : 
								"<a href='/warranties/create'>Assign Warranty</a>"
						!!}
					</td>
					<td>{{ $computer->status }}</td>
					<td class="detail">
						<a data-toggle="modal" href="#computer-{{$computer->id}}-info">View Details</a>
					</td>  
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection