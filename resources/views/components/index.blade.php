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
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"> --}}

<link href="{{ asset('css/crud.css') }}" rel="stylesheet">
@livewireStyles
@endpush

@section('content')

@livewire('warranty-create')
@livewire('warranty-details', [ 'model' => 'Component'])
@livewire('component-details')
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
				<th>DETAILS</th>
			</thead>
			<tbody>
				@foreach( $components as $component )
					<tr>
						<td>{{ $component->asset_tag }}</td>
						<td class="name">{{ $component->component_name }}</td>
						<td>{{ $component->type()->get()[0]->component_type }}</td>
						<td class="warranty">
							@if($component->warranty_id != null)
								<span onclick="getWarrantyInfo({{$component->warranty_id}})"><i class="fas fa-receipt" aria-hidden="true"></i> View Warranty</span>
							@else
								<span class="danger-red" onclick="showWarrantyCreate( 'Component', {{$component->id}} )"><i class="fas fa-receipt" aria-hidden="true"></i> Assign Warranty</span>
							@endif
						</td>
						<td>
                            <span class=
                                @if($component->status=='Assigned') 
                                    "text-danger"
                                @else
                                    "text-success"
                                @endif
                                >{{$component->status}}</span></td>
						<td class="detail">
							<a href="#" onclick="getComponentInfo({{$component->id}})"><i class="fa fa-info-circle" aria-hidden="true"></i> View Details</a>
						</td>  
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<!-- Add Component -->

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
							<label for="asset_tag" class="col-sm-3 col-form-label">Asset Tag<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<input  type="text" name="asset_tag" placeholder="Asset Tag" 
											class="form-control"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_name" class="col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<input  type="text" name="component_name" placeholder="Name" 
											class="form-control"
											required>
							</div>
						</div>
						<div class="form-group row">
							<label for="component_type" class="col-sm-3 col-form-label">Type<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<select name="component_type_id" class="custom-select" required>
									<option value="1">
										Motherboard
									</option>
									<option value="2">
										CPU
									</option>
									<option value="3">
										GPU
									</option>
									<option value="4">
										RAM
									</option>
									<option value="5">
										Storage
									</option>
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

@livewireScripts

@endsection