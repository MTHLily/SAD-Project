@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
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
	
<div class="modal" id="compDetails">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="compdet">
				Component Details
				<input type="text" name="asset_tag" placeholder="asset">
				<input type="text" name="component_name" placeholder="name">
				<select name="type">
					<option value="1">Motherboard</option>
					<option value="2">CPU</option>
					<option value="3">	GPU</option>
					<option value="4">	RAM</option>
					<option value="5">	Storage</option>
				</select>
			</div>

		</div>
	</div>
</div>


	<div class="container">

		<div class="row">
			<div class="col-12">
				<form class="form-inline float-sm-left">
					<div class="form-group mr-2">
						<h2>Component Inventory</h1>
					</div>
				</form>
				<form class="form-inline float-sm-right">
					<a data-toggle="modal" href="#component-add" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Add Item</a>
					<input type="text" class="form-control ml-2" id="searchBox" placeholder="Search">
				</form>
			</div>
		</div>
		
		<table class="table table-striped table-bordered dataTable mb-5">
			<thead>
				<th>ASSET TAG</th>
				<th>COMPONENT</th>
				<th>TYPE</th>
				<th>WARRANTY</th>
				<th>STATUS</th>
				<th>ITEM DETAILS</th>
			</thead>
			<tbody>
				@foreach( $components as $component )
					<tr>
						<td>{{ $component->asset_tag }}</td>
						<td class="name">{{ $component->component_name }}</td>
						<td>{{ $component->type()->get()[0]->component_type }}</td>
						<td class="warranty">
							{!! ($component->warranty_id != null) ? 
									"<a href='/warranties/$component->warranty_id'>View Warranty</a>" : 
									"<a data-toggle='modal' href='#assign-warranty'>Assign Warranty</a>"
							!!}
						</td>
						<td onclick="showCompDetails({{$component->id}})">{{ $component->status }}</td>
						<td class="detail">
							<a data-toggle="modal" href="#component-{{$component->id}}-info">View Details</a>
						</td>  
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	@foreach( $components as $component )

	<div class="modal fade" id="component-add" tabindex="-1" role="dialog">
  		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="/components" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Component</h5>
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
							<label for="component_name" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
								<input  type="text" name="component_name" placeholder="Name" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_type" class="col-sm-3 col-form-label">Type</label>
							<div class="col-sm-9">
								<select name="component_type_id" class="custom-select" required>
									<option value="1"
										@if($component->component_type_id == 1)
										selected
										@endif
									>
										Motherboard
									</option>
									<option value="2"
										@if($component->component_type_id == 2)
										selected
										@endif 
									>
										CPU
									</option>
									<option value="3"
										@if($component->component_type_id == 3)
										selected
										@endif 
									>
										GPU
									</option>
									<option value="4"
										@if($component->component_type_id == 4)
										selected
										@endif 
									>
										RAM
									</option>
									<option value="5"
										@if($component->component_type_id == 5)
										selected
										@endif 
									>
										Storage
									</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="issues" placeholder="Issues" 
											class="form-control" 
											value="{{$component->issues}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="remarks" placeholder="Remarks" 
											class="form-control" 
											value="{{$component->remarks}}">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
						<button type="submit" class="btn btn-success">Done</button>
					</div>
				</form>
    		</div>
  		</div>
	</div>

	@endforeach

	@foreach( $components as $component )

	<div class="modal fade" id="component-{{$component->id}}-info" tabindex="-1" role="dialog">
  		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Component Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
      			</div>
      			<div class="modal-body">
					<form action="/components/{{$component->id}}" method="POST">
						@csrf
						@method('PATCH')
						<div class="form-group row">
							<label for="asset_tag" class="col-sm-3 col-form-label">Asset Tag</label>
							<div class="col-sm-9">
								<input  type="text" name="asset_tag" placeholder="Asset Tag" 
											class="form-control" 
											value="{{$component->asset_tag}}" 
											readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_name" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
								<input  type="text" name="component_name" placeholder="Name" 
									class="form-control" 
									value="{{$component->component_name}}"
									readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_type" class="col-sm-3 col-form-label">Type</label>
							<div class="col-sm-9">
								<input  type="text" name="component_type" placeholder="Component Type" 
									class="form-control" 
									value="{{$component->type()->get()[0]->component_type}}"
									readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<input  type="text" name="status" placeholder="Component Status" 
									class="form-control" 
									value="{{$component->status}}"
									readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="issues" placeholder="Issues" 
									class="form-control" 
									value="{{$component->issues}}"
									readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="remarks" placeholder="Remarks" 
									class="form-control" 
									value="{{$component->remarks}}"
									readonly>
							</div>
						</div>
					</form>
      			</div>
				<div class="modal-footer">
					<form action="/components/{{$component->id}}" method="POST">
						@method('delete')
						@csrf
						<button type="submit"class="btn btn-success">Remove</button>
					</form>
					<a class="btn btn-success" name="update_new")">Update New</a>
					<a class="btn btn-success" data-toggle="modal" href="#component-{{$component->id}}-edit">Update</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">Return</button>
				</div>
    		</div>
  		</div>
	</div>
	
	@endforeach

	@foreach( $components as $component )

	<div class="modal fade" id="component-{{$component->id}}-edit" tabindex="-1" role="dialog">
  		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="/components/{{$component->id}}" method="POST">
					@csrf
					@method('PATCH')
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
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
											value="{{$component->asset_tag}}"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_name" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
								<input  type="text" name="component_name" placeholder="Name" 
											class="form-control" 
											value="{{$component->component_name}}"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_type" class="col-sm-3 col-form-label">Type</label>
							<div class="col-sm-9">
								<select name="component_type_id" class="custom-select" required>
									<option value="1"
										@if($component->component_type_id == 1)
										selected
										@endif
									>
										Motherboard
									</option>
									<option value="2"
										@if($component->component_type_id == 2)
										selected
										@endif 
									>
										CPU
									</option>
									<option value="3"
										@if($component->component_type_id == 3)
										selected
										@endif 
									>
										GPU
									</option>
									<option value="4"
										@if($component->component_type_id == 4)
										selected
										@endif 
									>
										RAM
									</option>
									<option value="5"
										@if($component->component_type_id == 5)
										selected
										@endif 
									>
										Storage
									</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_status" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<input  type="text" name="component_status" placeholder="Component Status" 
											class="form-control" 
											value="{{$component->status}}"
											readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="issues" placeholder="Issues" 
											class="form-control" 
											value="{{$component->issues}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="remarks" placeholder="Remarks" 
											class="form-control" 
											value="{{$component->remarks}}">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
						<button type="submit" class="btn btn-success">Done</button>
					</div>
				</form>
    		</div>
  		</div>
	</div>

	@endforeach

	<div class="modal fade" id="assign-warranty" tabindex="-1" role="dialog">
  		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="/components" method="POST">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Assign Warranty</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
							<label for="brand" class="col-sm-3 col-form-label">Brand</label>
							<div class="col-sm-9">
								<input  type="text" name="brand" placeholder="Brand" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="purchase_date" class="col-sm-3 col-form-label">Purchase Date</label>
							<div class="col-sm-9">
								<input  type="date" name="purchase_date"
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="purchase_location" class="col-sm-3 col-form-label">Purchase Location</label>
							<div class="col-sm-9">
								<input  type="text" name="purchase_location" placeholder="Purchase Location" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="reciept" class="col-sm-3 col-form-label">Reciept</label>
							<div class="col-sm-9">
								<input  type="file" name="reciept"
											class="form-control" 
											accept="image/png, image/jpeg"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="serial_number" class="col-sm-3 col-form-label">Serial Number</label>
							<div class="col-sm-9">
								<input  type="text" name="serial_number" placeholder="Serial Number" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="warranty_life" class="col-sm-3 col-form-label">Warranty Life</label>
							<div class="col-sm-9">
								<input  type="date" name="warranty_life" 
											class="form-control" 
											value=""
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="notes" class="col-sm-3 col-form-label">Notes</label>
							<div class="col-sm-9">
								<input  type="text" name="notes" placeholder="Notes" 
											class="form-control" 
											value="">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
						<button type="submit" class="btn btn-success">Done</button>
					</div>
				</form>
    		</div>
  		</div>
	</div>

@endsection