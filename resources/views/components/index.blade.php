@extends('layouts.app')

@push('scripts')
{{-- Font Awesome Import --}}
<script src="https://kit.fontawesome.com/c0401ef6be.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src=" {{asset('js/crud.js')}}"></script>
@endpush

@push('styles')
<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@endpush

@section('content')
	
	<div class="container">

		<div class="row">
			<div class="col-12">
				<form class="form-inline float-sm-left">
					<div class="form-group mr-2">
						<h1>Component Inventory</h1>
					</div>
				</form>
				<form class="form-inline float-sm-right">
					<a data-toggle="modal" href="#component-add" class="btn btn-success float-sm-right"><i class="fas fa-plus"></i> Add Item</a>
					<input type="text" class="form-control ml-2" placeholder="Search">
				</form>
			</div>
		</div>
		
		<table class="table table-striped table-bordered">
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
									"<a href='/warranties/create'>Assign Warranty</a>"
							!!}
						</td>
						<td>{{ $component->status }}</td>
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
							<label for="component_issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="component_issues" placeholder="Issues" 
											class="form-control" 
											value="{{$component->issues}}"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="component_remarks" placeholder="Remarks" 
											class="form-control" 
											value="{{$component->remarks}}"
											required>
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
							<label for="component_issues" class="col-sm-3 col-form-label">Issues</label>
							<div class="col-sm-9">
								<input  type="text" name="component_issues" placeholder="Issues" 
											class="form-control" 
											value="{{$component->issues}}"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_remarks" class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<input  type="text" name="component_remarks" placeholder="Remarks" 
											class="form-control" 
											value="{{$component->remarks}}"
											required>
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

@endsection