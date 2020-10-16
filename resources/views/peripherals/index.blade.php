@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script> --}}

<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"> --}}

<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@livewireStyles
@endpush

@section('content')

@livewire('warranty-create')
@livewire('warranty-details')

	<div class="container">

		
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				{{ $error }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>	
		@endforeach

		<div class="row">
			<div class="col-12">
				<form class="form-inline float-sm-left">
					<div class="form-group mr-2">
						<h2>Peripheral Inventory</h1>
					</div>
				</form>
				<form class="form-inline float-sm-right">
					<a data-toggle="modal" href="#peripheral-add" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Add Item</a>
					<input type="text" class="form-control ml-2" id="searchBox" placeholder="Search">
				</form>
			</div>
		</div>

		<table class="table table-striped table-bordered dataTable mb-5">
			<thead>
				<th>ASSET TAG</th>
				<th>PERIPHERAL</th>
				<th>TYPE</th>
				<th>WARRANTY</th>
				<th>STATUS</th>
				<th>DETAILS</th>
			</thead>
			<tbody>
				@foreach( $peripherals as $peripheral )
					<tr>
						<td>{{ $peripheral->asset_tag }}</td>
						<td class="name">{{ $peripheral->peripheral_name }}</td>
						<td>{{ $peripheral->type()->get()[0]->peripheral_type }}</td>
						<td class="warranty">
							@if($peripheral->warranty_id != null)
								<span onclick="getWarrantyInfo({{$peripheral->warranty_id}})"><i class="fa fa-info-circle" aria-hidden="true"></i> View Warranty</span>
							@else
								<span class="danger-red" onclick="showWarrantyCreate( 'Peripheral', {{$peripheral->id}} )"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Assign Warranty</span>
							@endif
						</td>
						<td>{{ $peripheral->status }}</td>
						<td class="detail">
							<a data-toggle="modal" onclick="getPeripheralInfo({{$peripheral->id}})" href="#peripheral-info"><i class="fa fa-info-circle" aria-hidden="true"></i> View Details</a>
						</td>  
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<!-- Add Peripheral -->

	<div class="modal fade" id="peripheral-add" tabindex="-1" role="dialog">
  		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="/peripherals" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Peripheral</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label for="asset_tag" class="col-sm-3 col-form-label">Asset Tag</label>
							<div class="col-sm-9">
								<input  type="text" name="asset_tag" placeholder="Asset Tag" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_name" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
								<input  type="text" name="peripheral_name" placeholder="Name" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="peripheral_type" class="col-sm-3 col-form-label">Type</label>
							<div class="col-sm-9">
								<select name="peripheral_type" class="custom-select" required>
								{{ $types = \App\PeripheralType::all() }}
								@foreach( $types as $type )
									<option value="{{$type->id}}">{{$type->peripheral_type}}</option>
								@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="issues" placeholder="Issues" 
											class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="remarks" placeholder="Remarks" 
											class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Back</button>
						<button type="submit" class="btn btn-success"><i class="fas fa-save    "></i> Add</button>
					</div>
				</form>
    		</div>
  		</div>
	</div>

	<!-- Peripheral Details -->
	@livewire( 'peripheral-details' )

@livewireScripts
@endsection