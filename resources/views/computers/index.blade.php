@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>

{{-- JQuery Import for Javascript --}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush

@section('content')

	<a href="/computers/create" class="btn btn-success w-100"><i class="fas fa-plus"></i> Add New</a>
	<table class="table">
		<thead>
			<th></th>
			<th>Asset Tag</th>
			<th>PC Name</th>
			<th>Type</th>
			<th>Department</th>
			<th>System Details</th>
			<th>Network Details</th>
			<th>Warranty Details</th>
			<th>Remarks</th>
			<th>Issues</th>
			<th>Status</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach( $computers as $computer )
				<tr>
					<td></td>
					<td>{{ $computer->asset_tag }}</td>
					<td>{{ $computer->pc_name }}</td>
					<td>{{ $computer->type }}</td>
					<td>{{ $computer->department_id }}</td>
					<td>
						@if($computer->system_details_id != null)
							<a href="/computers/system_details/{{ $computer->department_id }}">View System Details</a>
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
							<button class="btn" type="button" data-toggle="modal" data-target="#network_modal_{{$computer->id}}">Assign Network Details</button>
						@endif
				</td>
					<td>
						{!! ($computer->warranty_id != null) ? 
								"<a href='/warranties/$computer->warranty_id'>View Warranty</a>" : 
								"<a href='/warranties/create'>Assign Warranty</a>"
						!!}
					</td>
					<td>{{ $computer->remarks }}</td>
					<td>{{ $computer->issues }}</td>
					<td>{{ $computer->status }}</td>
					<td>
						<div class="d-flex w-100">
							<a class="btn w-100" href="/computers/{{$computer->id}}/edit"><i class="fas fa-edit fa-lg"></i></a>
							<form class="w-100" action="/computers/{{$computer->id}}" method="POST">
								@method('delete')
								@csrf
								<button type="submit" class="btn w-100"><i class="fas fa-trash-alt fa-lg"></i></button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection